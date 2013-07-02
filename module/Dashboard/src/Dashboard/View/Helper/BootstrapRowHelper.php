<?php
/**
 * Helps to create rows with widgets for Bootstrap
 *
 * @author Konrad Turczynski <konrad.turczynski@schibsted.pl>
 */
namespace Dashboard\View\Helper;

use Zend\View\Helper\AbstractHelper;

class BootstrapRowHelper extends AbstractHelper {
    /**
     * Prepares rows with widgets for Bootstrap
     *
     * @param array $widgetCollection Array of instances of \Dashboard\Model\Widget\AbstractWidget
     * @throws \Exception
     * @return string
     */
    public function __invoke(array $widgetCollection) {
        $span = 0;
        $html = '';

        /* @var $widget \Dashboard\Model\Widget\AbstractWidget */
        foreach ($widgetCollection as $widget) {

            if (!is_numeric($widget->getParam('span'))) {
                throw new \Exception('Span value of ' . $widget->getId() . ' widget is not numeric or is not specified');
            }

            $span += $widget->getParam('span');
            if ($span > 12) {
                $html .= '</div><div class="row-fluid">';
                $span = $widget->getParam('span');;
            }

            // Using partial helper for retrieving view of each widget
            $html .= $this->view->partial($widget->getTplName(), array(
                    'widgetId' => $widget->getId(),
                    'widgetType' => $widget->getWidgetTypeName(),
                    'params' => $widget->getParams(),
                    'threshold' => $widget->getThreshold(),
                )
            );
        }

        return $html;
    }
}
