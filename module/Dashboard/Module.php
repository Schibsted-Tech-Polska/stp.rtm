<?php
namespace Dashboard;

use Dashboard\Model\Dao\JenkinsDao;
use Dashboard\Model\Dao\NewRelicDao;
use Dashboard\Model\Widget\WidgetFactory;
use Zend\ServiceManager\ServiceManager;

class Module {
    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig() {
        return array(
            'factories' => array(
                'WidgetConfig' => function(ServiceManager $serviceManager) {
                    return include('config/widget/widgets.config.php');
                },
                'JenkinsDaoConfig' => function (ServiceManager $serviceManager) {
                    return include('config/dao/JenkinsDao.config.php');
                },
                'JenkinsDao' => function (ServiceManager $serviceManager) {
                    return new JenkinsDao($serviceManager->get('JenkinsDaoConfig'));
                },
                'NewRelicDaoConfig' => function (ServiceManager $serviceManager) {
                    return include('config/dao/NewRelicDao.config.php');
                },
                'NewRelicDao' => function (ServiceManager $serviceManager) {
                    return new NewRelicDao($serviceManager->get('NewRelicDaoConfig'));
                },
                'WidgetFactory' => function(ServiceManager $serviceManager) {
                    return new WidgetFactory($serviceManager->get('WidgetConfig'));
                }
            ),
        );
    }
}
