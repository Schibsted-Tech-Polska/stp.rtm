<?php
/**
 * Main class responsible for rtm widgets management
 *
 * @author Konrad Turczynski <konrad.turczynski@schibsted.pl>
 */
namespace Dashboard\Model;

use Zend\Di\ServiceLocator;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceManager;

class DashboardManager {
    /**
     * Zend service locator
     *
     * @var \Zend\ServiceManager\ServiceLocatorInterface
     */
    private $serviceLocator;
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
     * @param string $rtmConfigName Config name retrieved from the url.
     * @param ServiceLocatorInterface $serviceLocator Interface for retrieving services.
     * @internal param array $configName Dashboard's config
     */
    public function __construct($rtmConfigName, ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
        $this->loadConfig($rtmConfigName);
        $this->init();
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
     * Creates dashboard's widget collection based on the custom config file
     */
    public function init() {
        $widgetFactory = $this->getServiceLocator()->get('WidgetFactory');

        foreach ($this->rtmConfig['widgets'] as $widgetData) {
            $widget = $widgetFactory->build($widgetData);
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

    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator() {
        return $this->serviceLocator;
    }
}
