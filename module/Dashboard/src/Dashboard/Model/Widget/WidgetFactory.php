<?php
/**
 * Factory responsible for creating concrete widgets.
 *
 * @author Konrad Turczynski <konrad.turczynski@schibsted.pl>
 */
namespace Dashboard\Model\Widget;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class WidgetFactory implements ServiceLocatorAwareInterface {
    /**
     * Service locator
     *
     * @var ServiceLocatorInterface
     */
    private $serviceLocator;
    /**
     * Array of default widget configuration
     *
     * @var array
     */
    private $widgetConfig;

    /**
     * Constructor
     *
     * @param array $widgetConfig Default widget configuration.
     */
    public function __construct(array $widgetConfig) {
        $this->widgetConfig = $widgetConfig;
    }

    /**
     * Creates instance of the widget
     *
     * @param mixed $daoParams
     * @param array $widgetData
     * @throws \Exception
     * @return AbstractWidget
     */
    public function build($daoParams,array $widgetData) {
        $widgetClass = __NAMESPACE__ . '\\' . ucfirst($widgetData['type']) . 'Widget';

        if (class_exists($widgetClass)) {
            // Merging default widget params with params defined in rtm custom config
            $params = array_merge($this->widgetConfig[$widgetData['type']], $widgetData['params']);

            /* @var AbstractWidget $widget */
            $widget = new $widgetClass($params);

            $daoClassName = ucfirst($widget->getParam('dao') . 'Dao');
            $dao = $this->getServiceLocator()->get($daoClassName);
            $dao->setParams($daoParams);

            $widget->setDao($dao);
            $widget->setId($widgetData['id']);

            return $widget;
        } else {
            throw new \Exception('Invalid widget type given.');
        }
    }

    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator Service locator interface.
     * @return $this
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator;

        return $this;
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
