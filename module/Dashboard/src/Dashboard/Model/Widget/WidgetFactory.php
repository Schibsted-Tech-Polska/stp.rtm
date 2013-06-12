<?php
/**
 * Factory responsible for creating concrete widgets.
 *
 * @author Konrad Turczynski <konrad.turczynski@schibsted.pl>
 */
namespace Dashboard\Model\Widget;

class WidgetFactory {
    /**
     * Array of default widget configuration
     *
     * @var array
     */
    private $widgetConfig;

    /**
     * Constructor
     *
     * @param array $widgetConfig Default widget configuration array.
     */
    public function __construct(array $widgetConfig) {
        $this->widgetConfig = $widgetConfig;
    }

    /**
     * Creates instance of the widget
     *
     * @param array $widgetData Widget's data from the custom config file.
     * @throws \Exception
     * @return AbstractWidget
     */
    public function build(array $widgetData) {
        $type = $widgetData['type'];

        $widgetClass = __NAMESPACE__ . '\\' . ucfirst($type) . 'Widget';
        if (class_exists($widgetClass)) {
            var_dump($this->widgetConfig[$type]);

            $params = array_merge($this->widgetConfig[$type]['params'], $widgetData['params']);

            var_dump($params);

            return new $widgetClass();
        } else {
            throw new \Exception('Invalid widget type given.');
        }
    }
}
