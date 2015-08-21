<?php
/**
 * @author pdziok
 */
namespace Dashboard\Model;

use Dashboard\Model\Widget\AbstractWidget;
use Dashboard\Model\Analyzer\AnalyzerFactory;
use Symfony\Component\Process\Process;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\EventManager\EventManagerInterface;

class AnalyzerRunner implements EventManagerAwareInterface
{
    /** @var Process[] */
    private $processes = [];
    use EventManagerAwareTrait;

    /** @var  DashboardManager */
    private $dashboardManager;

    public function __construct(DashboardManager $dashboardManager)
    {
        $this->dashboardManager = $dashboardManager;
        /** @var EventManagerInterface $eventManager */
        $eventManager = $dashboardManager->getServiceLocator()->get('eventmanager');
        $this->setEventManager($eventManager);
    }

    public function runAggregated()
    {
        $widgets = $this->dashboardManager->getWidgets();

        $filteredWidgets = [];
        /** @var AbstractWidget $widget */
        foreach ($widgets as $widget) {
            $thresholds = $widget->getThreshold();
            $thresholds = array_filter($thresholds);

            if (!$thresholds) {
                $this->logLn('[Master] Skipping "%s" due to lack of thresholds', $widget->getId());
            } elseif (!$widget->getParam('analyze')) {
                $this->logLn('[Master] Skipping "%s" due to lack of analyzer config', $widget->getId());
            } else {
                $filteredWidgets[] = $widget;
            }
        }

        /** @var Process[] $processes */
        foreach ($filteredWidgets as $widget) {
            $this->logLn(
                '[Master] Monitoring "%s" with:%s * thresholds: %s%s * analyzer config: %s',
                $widget->getId(),
                PHP_EOL,
                json_encode($widget->getThreshold()),
                PHP_EOL,
                json_encode($widget->getParam('analyze'))
            );

            $cmd = $this->prepareCommand($widget);
            $process = new Process($cmd);
            $process->start(function ($type, $message) use ($widget) {
                $this->log('[%s] %s', $widget->getId(), $message);
            });

            $this->processes[$widget->getId()] = $process;
        }

        while (true) {
            sleep(1);

            foreach ($this->processes as $widgetId => $process) {
                if (!$process->isRunning()) {
                    $this->logLn(sprintf('%s: %s', $widgetId, $process->getStatus()));
                    $process->restart(function ($type, $message) use ($widget) {
                        $this->log('[%s] %s', $widget->getId(), $message);
                    });
                }
            }
        }
    }

    public function run($widgetId)
    {
        /** @var AbstractWidget $widget */
        $widget = $this->dashboardManager->getWidget($widgetId);
        $factory = new AnalyzerFactory();

        $analyzer = $factory->createFor($widget);

        $cfg = $widget->getParam('analyze');
        $sleepFor = isset($cfg['each'])
            ? \DateInterval::createFromDateString($cfg['each'])->format('%s')
            : 60;

        $this->logLn('Ready!');

        while (true) {
            $analyzeResult = $analyzer->analyze();

            if (!$analyzeResult->isOK()) {
                $this->logLn(
                    'Violation found @ %s: %s',
                    $analyzeResult->getApplication(),
                    $analyzeResult->getMessage()
                );
                $this->events->trigger('analyzer.violation', $this, [$analyzeResult, $widget->getParams()]);
            }

            sleep($sleepFor);
        }
    }

    /**
     * @param $message
     */
    private function log($message)
    {
        if (func_num_args() > 1) {
            $message = vsprintf($message, array_slice(func_get_args(), 1));
        }

        file_put_contents('php://stdout', $message);
    }

    /**
     * @param $message
     */
    private function logLn($message)
    {
        $message .= PHP_EOL;

        if (func_num_args() > 1) {
            call_user_func_array([$this, 'log'], array_merge([$message], array_slice(func_get_args(), 1)));
        } else {
            $this->log($message);
        }
    }

    /**
     * @param $widget
     * @return string
     */
    private function prepareCommand(AbstractWidget $widget)
    {
        $argv = $_SERVER['argv'];
        $cmd = sprintf('php %s %s %s %s', $argv[0], $argv[1], $argv[2], $widget->getId());

        return $cmd;
    }

    public function __destruct()
    {
        foreach ($this->processes as $name => $process) {
            $this->logLn('Killing child process: %s', $name);
            $process->stop();
        }
    }
}
