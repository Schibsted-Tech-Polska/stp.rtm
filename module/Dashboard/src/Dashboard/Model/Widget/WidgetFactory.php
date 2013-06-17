<?php
/**
 * Factory responsible for creating concrete widgets.
 *
 * @author Konrad Turczynski <konrad.turczynski@schibsted.pl>
 */
namespace Dashboard\Model\Widget;

use Dashboard\Model\Widget\Exception\InvalidWidgetTypeException;
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
     * Array of default widget configuration (widgets.config.php)
     *
     * @var array
     */
    private $widgetDefaultConfig;

    /**
     * Constructor
     *
     * @param array $widgetConfig Default widget configuration.
     */
    public function __construct(array $widgetConfig) {
        $this->widgetDefaultConfig = $widgetConfig;
    }

    /**
     * Creates instance of the widget
     *
     * @param array      $widgetData Widget data from rtm config
     * @param array|null $daoParams  Dao parameters array
     * @throws InvalidWidgetTypeException
     * @return AbstractWidget
     */
    public function build(array $widgetData, $daoParams) {
        $widgetClass = __NAMESPACE__ . '\\' . ucfirst($widgetData['type']) . 'Widget';

        if (class_exists($widgetClass)) {
            // Merging default widget params with params defined in rtm custom config
            $params = array_merge($this->widgetDefaultConfig[$widgetData['type']], $widgetData['params']);

            /* @var AbstractWidget $widget */
            $widget = new $widgetClass($params);

            $daoClassName = ucfirst($widget->getParam('dao') . 'Dao');
            $dao = $this->getServiceLocator()->get($daoClassName);
            $dao->setDaoOptions($daoParams);

            $widget->setDao($dao);
            $widget->setId($widgetData['id']);

            return $widget;
        } else {
            throw new InvalidWidgetTypeException('Invalid widget type given: ' . $widgetClass);
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
