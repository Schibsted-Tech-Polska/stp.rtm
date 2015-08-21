<?php

namespace Dashboard\Model\Analyzer;

use Dashboard\Model\Widget\AbstractWidget;
use Zend\Log\LoggerAwareInterface;
use Zend\Log\LoggerAwareTrait;

/**
 * @author pdziok
 */

abstract class AbstractAnalyzer implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    const METHOD_ALL = 'all';
    const METHOD_ANY = 'any';
    const METHOD_AVG = 'avg';
    const METHOD_MEDIAN = 'median';

    const LOWER_IS_BETTER = 1;
    const HIGHER_IS_BETTER = -1;

    /** @var  AbstractWidget */
    protected $widget;
    protected $comparisonMethod;

    public function __construct($widget)
    {
        $this->widget = $widget;
    }

    /**
     * @return mixed
     */
    abstract public function analyze();

    /**
     * @param $method
     * @param $data
     * @return float|mixed
     */
    protected function calculateResult($method, $data)
    {
        $count = count($data);

        switch ($method) {
            case AbstractAnalyzer::METHOD_ALL:
                $result = min($data);
                break;
            case AbstractAnalyzer::METHOD_ANY:
                $result = max($data);
                break;
            case AbstractAnalyzer::METHOD_AVG:
                $result = array_sum($data) / $count;
                break;
            case AbstractAnalyzer::METHOD_MEDIAN:
                $middleIndex = (int)floor($count / 2);
                sort($data, SORT_NUMERIC);
                $result = $data[$middleIndex]; // assume an odd # of items
                // Handle the even case by averaging the middle 2 items
                if ($count % 2 == 0) {
                    $result = ($result + $data[$middleIndex - 1]) / 2;
                }
                break;
            default:
                throw new \InvalidArgumentException(sprintf('Unknown method "%s"', $method));
        }

        return $result;
    }

    protected function compare($value, $with)
    {
        if ($this->comparisonMethod == AbstractAnalyzer::HIGHER_IS_BETTER) {
            if ($value <= $with) {
                return true;
            }

            return false;
        }

        if ($value >= $with) {
            return true;
        }

        return false;
    }

    protected function generateMessage($title, $status, $result, $suffix, $threshold)
    {
        return sprintf(
            '%s is %s - current value is: %s %s. Threshold is %s',
            $title,
            $status,
            $result,
            $suffix,
            $threshold
        );
    }
}
