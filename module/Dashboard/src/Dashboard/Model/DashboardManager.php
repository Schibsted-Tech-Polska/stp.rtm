<?php
/**
 * Provides
 *
 * @author Konrad Turczynski <konrad.turczynski@schibsted.pl>
 */
namespace Dashboard\Model;


class DashboardManager {

    /**
     * Basic configuration of all available widget types
     *
     * @var array
     */
    private $widgetsConfig;
    /**
     * Rtm custom config
     *
     * @var array
     */
    private $rtmConfig = array();

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
    public function __construct($widgetsConfig) {
        $this->widgetsConfig = $widgetsConfig;
    }

    /**
     * Loads configuration array from rtm config file
     *
     * @param string $configName Config file name retrieved from url
     * @throws \Exception
     */

    public function loadConfig($configName) {

        $configFilePath = 'config/rtm/' . $configName . '.config.php';

        if (file_exists($configFilePath)) {
            $this->rtmConfig = include($configFilePath);
        } else {
            throw new \Exception('Cannot find config file');
        }
    }

    /**
     * Initiates configuration from the given config
     *
     */
    public function init() {

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
