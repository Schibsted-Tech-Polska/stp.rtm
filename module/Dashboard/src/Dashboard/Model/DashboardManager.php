<?php
/**
 * Main class responsible for rtm widgets management
 *
 * @author Konrad Turczynski <konrad.turczynski@schibsted.pl>
 */
namespace Dashboard\Model;

use Zend\Di\ServiceLocator;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceManager;

/**
 * Class DashboardManager
 *
 * @package Dashboard\Model
 */
class DashboardManager
{
    /**
     * Default dashboard's theme name
     *
     * @var
     */
    const DEFAULT_THEME = 'dark';

    /**
     * Path to dir with rtm configs (relative to app root)
     *
     * @var string
     */
    const RTM_CONFIG_DIR = 'config/rtm';

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
     * Name of the Dashboard instance
     *
     * @var string
     */
    private $resourceName;

    /**
     * Stores all types of widgets used by a dashboard
     *
     * @var
     */
    private $widgetTypes = array();

    /**
     * Constructor
     *
     * @param string $resourceName Config name retrieved from URL.
     * @param ServiceLocatorInterface $serviceLocator Interface for retrieving services.
     * @param string $widgetId Id of a single widget to create for this dashboard (not all of them)
     * @internal param array $configName Dashboard's config
     */
    public function __construct($resourceName, ServiceLocatorInterface $serviceLocator, $widgetId = null)
    {
        $this->serviceLocator = $serviceLocator;
        $this->setResourceName($resourceName);
        $this->loadConfig($resourceName);
        $this->initWidgetCollection($widgetId);
    }

    /**
     * Returns all types of widgets used by a dashboard
     *
     * @return array
     */
    public function getWidgetTypes()
    {
        return $this->widgetTypes;
    }

    /**
     * Loads configuration array from rtm config file
     *
     * @param  string $resourceName Config file name retrieved from url
     * @throws \Exception
     */
    public function loadConfig($resourceName)
    {
        $configFilePath = self::RTM_CONFIG_DIR . '/' . $resourceName . '.config.php';

        if (file_exists($configFilePath)) {
            $this->rtmConfig = include($configFilePath);
        } else {
            throw new \Exception('Cannot find config file ' . $resourceName);
        }
    }

    /**
     * Creates dashboard's widget collection based on the custom config file
     *
     * @param string|null $widgetId Id of a single widget we want to create
     */
    public function initWidgetCollection($widgetId = null)
    {
        $widgetFactory = $this->getServiceLocator()->get('WidgetFactory');

        foreach ($this->rtmConfig['widgets'] as $widgetData) {
            if (is_null($widgetId) || $widgetData['id'] == $widgetId) {
                $daoParams = array();
                if (isset($widgetData['params']['dao']) && isset($this->rtmConfig[$widgetData['params']['dao']])) {
                    $daoParams = $this->rtmConfig[$widgetData['params']['dao']];

                }

                if (isset($widgetData['params']['daoOptions'])) {
                    $daoParams = array_replace_recursive($daoParams, $widgetData['params']['daoOptions']);
                }

                $widget = $widgetFactory->build($widgetData, $daoParams, $this->getResourceName());
                $this->addWidget($widget);
            }
        }
    }

    /**
     * Adds widget to widget collection
     *
     * @param Widget\AbstractWidget $widget Concrete widget object
     */
    public function addWidget(Widget\AbstractWidget $widget)
    {
        $this->widgetsCollection[$widget->getId()] = $widget;
        $this->widgetTypes[$widget->getWidgetTypeName()] = $widget->getWidgetTypeName();
    }

    /**
     * Returns concrete instance of widget with the given identifier
     *
     * @param  string $id Widget's id
     * @throws \Exception
     * @return mixed
     */
    public function getWidget($id)
    {
        if (isset($this->widgetsCollection[$id])) {
            return $this->widgetsCollection[$id];
        } else {
            throw new \Exception('Widget with ' . $id . ' id is not specified in rtm config');
        }
    }

    /**
     * Returns a collection of Widgets added to this Dashboard.
     *
     * @return array
     */
    public function getWidgets()
    {
        return $this->widgetsCollection;
    }

    /**
     * Returns service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * Resource name setter
     *
     * @param string $resourceName Resource name
     */
    protected function setResourceName($resourceName)
    {
        $this->resourceName = $resourceName;
    }

    /**
     * Resource name getter
     *
     * @return string
     */
    public function getResourceName()
    {
        return $this->resourceName;
    }

    /**
     * Returns name of a theme file used to style dashboard
     *
     * @return string
     */
    public function getThemeName()
    {
        if (isset($this->rtmConfig['theme'])) {
            return $this->rtmConfig['theme'];
        }

        return self::DEFAULT_THEME;
    }
}
