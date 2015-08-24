<?php
/**
 * @author pdziok
 */
namespace Dashboard\Model\Analyzer;

use Dashboard\Model\Widget\NumberWidget;

class NumberAnalyzer extends AbstractAnalyzer
{
    private $archive;
    private $samples;

    public function __construct(NumberWidget $widget)
    {
        parent::__construct($widget);

        $cfg = $widget->getParam('analyze');

        $secondsToAnalyze = $this->intervalToSeconds($cfg['last']);
        $frequency = isset($cfg['each'])
            ? $this->intervalToSeconds($cfg['each'])
            : 60;
        $this->samples = ceil($secondsToAnalyze / $frequency);
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

        $application = isset($params['app']) ? $params['app'] : '';

        return new AnalyzerResult($this->widget->getId(), $status, $params['metric'], $message, $application);
    }

    /**
     * @return array
     */
    private function gatherImportantData()
    {
        $this->archive[] = $this->widget->fetchData();

        if (count($this->archive) > $this->samples) {
            array_shift($this->archive);
        }

        return $this->archive;
    }

    private function intervalToSeconds($value)
    {
        $interval = \DateInterval::createFromDateString($value);

        return ($interval->y * 365 * 24 * 60 * 60) +
        ($interval->m * 30 * 24 * 60 * 60) +
        ($interval->d * 24 * 60 * 60) +
        ($interval->h * 60 * 60) +
        ($interval->i * 60) +
        $interval->s;
    }
}
