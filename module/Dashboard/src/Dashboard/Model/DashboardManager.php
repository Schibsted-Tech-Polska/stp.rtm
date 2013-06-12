<?php
/**
 * Provides
 *
 * @author Konrad Turczynski <konrad.turczynski@schibsted.pl>
 */
namespace Dashboard\Model;


class DashboardManager {

    /**
     * Dashboard's config
     *
     * @var array
     */
    private $config = array();

    /**
     * Collection of dashboard's widget
     *
     * @var array
     */
    private $widgetsCollection = array();

    /**
     * Constructor
     *
     * @param array $configName dashboard's config
     */
    public function __construct($configName) {
        $this->loadConfig($configName);
        $this->init();
    }

    /**
     * Loads configuration array from rtm config file
     *
     * @param string $configName Config file name retrieved from url
     * @throws \Exception
     */

    private function loadConfig($configName) {

        $configFilePath = 'config/' . $configName . '.config.php';

        if (file_exists($configFilePath)) {
            $this->config = include($configFilePath);
        } else {
            throw new \Exception('Cannot find config file');
        }
    }

    /**
     * Initiates configuration from the given config
     *
     */
    public function init() {
        foreach ($this->config['resources'] as $resourceType => $resourceData) {
                $widgetObject = Widget\WidgetFactory::build($widgetParams['type']);
        }
    }

    /**
     * Adds widget to widget collection
     *
     * @param Widget\AbstractWidget $widget Concrete widget object
     */
    public function addWidget(Widget\AbstractWidget $widget) {
        $this->widgetsCollection;
    }
}
