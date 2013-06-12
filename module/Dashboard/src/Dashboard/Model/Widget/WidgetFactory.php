<?php
/**
 *
 * @author Konrad Turczynski <konrad.turczynski@schibsted.pl>
 */
namespace Dashboard\Model\Widget;

class WidgetFactory {
    /**
     * Creates instances of the widgets
     *
     * @param string $type Type of the widget
     * @return AbstractWidget
     * @throws \Exception
     */
    public static function build($type) {
        $widgetClass = __NAMESPACE__ . '\\' . ucfirst($type) . 'Widget';
        if (class_exists($widgetClass)) {
            return new $widgetClass();
        } else {
            throw new \Exception('Invalid widget type given.');
        }
    }
}
