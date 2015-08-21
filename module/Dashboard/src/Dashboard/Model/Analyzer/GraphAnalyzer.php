<?php
/**
 * @author pdziok
 */
namespace Dashboard\Model\Analyzer;

use Dashboard\Model\Widget\GraphWidget;

class GraphAnalyzer extends AbstractAnalyzer implements AnalyzerInterface
{
    public function __construct(GraphWidget $widget)
    {
        parent::__construct($widget);
    }

    public function analyze()
    {
        $params = $this->widget->getParams();
        $cfg = $params['analyze'];
        $data = $this->gatherImportantData();

        $method = isset($cfg['method'])
            ? $cfg['method']
            : self::METHOD_AVG;

        $result = $this->calculateResult($method, $data);

        $thresholds = $this->widget->getThreshold();

        $this->comparisonMethod = self::HIGHER_IS_BETTER;
        if (!isset($params['thresholdComparator']) || $params['thresholdComparator'] == 'lowerIsBetter') {
            $this->comparisonMethod = self::LOWER_IS_BETTER;
        }

        $suffix = isset($params['valueSuffix']) ? $params['valueSuffix'] : '';

        $title = $params['title'];
        if ($this->compare($result, $thresholds['critical-value'])) {
            //omg omg omg! critical
            $status = AnalyzerResult::CRITICAL;
            $message = $this->generateMessage($title, 'CRITICAL', $result, $suffix, $thresholds['critical-value']);
        } elseif ($this->compare($result, $thresholds['caution-value'])) {
            $status = AnalyzerResult::CAUTION;
            $message = $this->generateMessage($title, 'CAUTION', $result, $suffix, $thresholds['caution-value']);
        } else {
            $status = AnalyzerResult::OK;
            $message = sprintf('%s is OK - current value is: %s %s', $title, $result, $suffix);
        }

        $message = rtrim($message);

        return new AnalyzerResult($this->widget->getId(), $status, $params['metric'], $message, $params['app']);
    }

    /**
     * @return array
     */
    private function gatherImportantData()
    {
        $data = $this->widget->fetchData();
        $params = $this->widget->getParams();

        $cfg = $params['analyze'];

        $currentDate = new \DateTime();
        $since = $currentDate->sub(\DateInterval::createFromDateString($cfg['last']))->getTimestamp();

        $importantData = [];
        for ($i = count($data) - 1; $i >= 0; $i--) {
            $possibleImportant =& $data[$i];
            if (($possibleImportant['x'] / 1000) - 7200 > $since) {
                $importantData[] = $possibleImportant['y'];
            }
        }

        return $importantData;
    }
}
