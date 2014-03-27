<?php
namespace Dashboard;

use Dashboard\Model\Dao\BambooDao;
use Dashboard\Model\Dao\EventsDao;
use Dashboard\Model\Dao\GearmanDao;
use Dashboard\Model\Dao\JenkinsDao;
use Dashboard\Model\Dao\NewRelicDao;
use Dashboard\Model\Dao\SplunkDao;
use Dashboard\Model\Dao\TeamcityDao;
use Dashboard\Model\Dao\SmogDao;
use Dashboard\Model\Dao\HipChatDao;
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
                    return new JenkinsDao($serviceManager->get('JenkinsDaoConfig'));
                },
                'NewRelicDaoConfig' => function (ServiceManager $serviceManager) {
                    return include('config/dao/NewRelicDao.config.php');
                },
                'NewRelicDao' => function (ServiceManager $serviceManager) {
                    return new NewRelicDao($serviceManager->get('NewRelicDaoConfig'));
                },
                'EventsDaoConfig' => function (ServiceManager $serviceManager) {
                    return include('config/dao/EventsDao.config.php');
                },
                'EventsDao' => function (ServiceManager $serviceManager) {
                    return new EventsDao($serviceManager->get('EventsDaoConfig'));
                },
                'GearmanDaoConfig' => function (ServiceManager $serviceManager) {
                        return include('config/dao/GearmanDao.config.php');
                    },
                'GearmanDao' => function (ServiceManager $serviceManager) {
                        return new GearmanDao($serviceManager->get('GearmanDaoConfig'));
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
                'SplunkDaoConfig' => function (ServiceManager $serviceManager) {
                    return include('config/dao/SplunkDao.config.php');
                },
                'SplunkDao' => function (ServiceManager $serviceManager) {
                    return new SplunkDao($serviceManager->get('SplunkDaoConfig'));
                },
                'TeamcityDaoConfig' => function (ServiceManager $serviceManager) {
                    return include('config/dao/TeamcityDao.config.php');
                },
                'TeamcityDao' => function (ServiceManager $serviceManager) {
                    return new TeamcityDao($serviceManager->get('TeamcityDaoConfig'));
                },
                'SmogDaoConfig' => function (ServiceManager $serviceManager) {
                    return include('config/dao/SmogDao.config.php');
                },
                'SmogDao' => function (ServiceManager $serviceManager) {
                    return new SmogDao($serviceManager->get('SmogDaoConfig'));
                }
                'HipChatDaoConfig' => function (ServiceManager $serviceManager) {
                    return include('config/dao/HipChatDao.config.php');
                },
                'HipChatDao' => function (ServiceManager $serviceManager) {
                    return new HipChatDao($serviceManager->get('HipChatDaoConfig'));
                },
                'BambooDaoConfig' => function (ServiceManager $serviceManager) {
                        return include('config/dao/BambooDao.config.php');
                },
                'BambooDao' => function (ServiceManager $serviceManager) {
                        return new BambooDao($serviceManager->get('BambooDaoConfig'));
                },
            ),
        );
    }
}
