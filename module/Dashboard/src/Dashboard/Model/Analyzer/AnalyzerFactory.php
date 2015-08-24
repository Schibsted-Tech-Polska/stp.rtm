<?php
/**
 * @author pdziok
 */
namespace Dashboard\Model\Analyzer;

use Dashboard\Model\Widget\AbstractWidget;
use Dashboard\Model\Widget\GraphWidget;
use Dashboard\Model\Widget\NumberWidget;

class AnalyzerFactory
{
    public function createFor(AbstractWidget $widget)
    {
        if ($widget instanceof GraphWidget) {
            return new GraphAnalyzer($widget);
        } elseif ($widget instanceof NumberWidget) {
            return new NumberAnalyzer($widget);
        }

        throw new \InvalidArgumentException('Unsupported widget type');
    }
}
