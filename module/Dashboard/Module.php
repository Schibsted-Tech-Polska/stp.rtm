<?php
namespace Dashboard;

use Dashboard\Model\Dao\EventsDao;
use Dashboard\Model\Dao\JenkinsDao;
use Dashboard\Model\Dao\NewRelicDao;
use Dashboard\Model\Widget\WidgetFactory;
use Zend\Cache\Storage\Adapter\Memcached;
use Zend\Cache\Storage\Adapter\MemcachedOptions;
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
                'WidgetConfig' => function (ServiceManager $serviceManager) {
                    return include('config/widget/widgets.config.php');
                },
                'JenkinsDaoConfig' => function (ServiceManager $serviceManager) {
                    return include('config/dao/JenkinsDao.config.php');
                },
                'JenkinsDao' => function (ServiceManager $serviceManager) {
                    return new JenkinsDao($serviceManager->get('JenkinsDaoConfig'), null, $serviceManager->get('CacheAdapter'));
                },
                'NewRelicDaoConfig' => function (ServiceManager $serviceManager) {
                    return include('config/dao/NewRelicDao.config.php');
                },
                'NewRelicDao' => function (ServiceManager $serviceManager) {
                    return new NewRelicDao($serviceManager->get('NewRelicDaoConfig'), null, $serviceManager->get('CacheAdapter'));
                },
                'EventsDaoConfig' => function (ServiceManager $serviceManager) {
                    return include('config/dao/EventsDao.config.php');
                },
                'EventsDao' => function (ServiceManager $serviceManager) {
                    return new EventsDao($serviceManager->get('EventsDaoConfig'), null, $serviceManager->get('CacheAdapter'));
                },
                'WidgetFactory' => function (ServiceManager $serviceManager) {
                    return new WidgetFactory($serviceManager->get('WidgetConfig'));
                },
                'CacheAdapter' => function ($serviceManager) {
                    $cacheAdapter = new Memcached($serviceManager->get('CacheAdapterOptions'));
                    return $cacheAdapter;
                },
                'CacheAdapterOptions' => function ($serviceManager) {
                    $config = $serviceManager->get('Config');
                    return new MemcachedOptions($config['dashboardCache']);
                },
            ),
        );
    }
}
