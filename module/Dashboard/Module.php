<?php
namespace Dashboard;

use Zend\Cache\Storage\Adapter\Memcached;
use Zend\Cache\Storage\Adapter\MemcachedOptions;
use Zend\ServiceManager\ServiceManager;

class Module
{
    public function getConfig()
    {
        return array_merge_recursive(
            include __DIR__ . '/config/module.config.php',
            $this->autoloadConfigs(__DIR__ . '/config/autoload')
        );
    }

    public function getAutoloaderConfig()
    {
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
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'WidgetConfig' => function (ServiceManager $serviceManager) {
                        return $serviceManager->get('Config')['widgetsConfig'];
                },
                'JenkinsDaoConfig' => function (ServiceManager $serviceManager) {
                        return $serviceManager->get('Config')['JenkinsDao'];
                },
                'JenkinsDao' => function (ServiceManager $serviceManager) {
                        return new Model\Dao\JenkinsDao($serviceManager->get('JenkinsDaoConfig'));
                },
                'NewRelicDaoConfig' => function (ServiceManager $serviceManager) {
                        return $serviceManager->get('Config')['NewRelicDao'];
                },
                'NewRelicDao' => function (ServiceManager $serviceManager) {
                        return new Model\Dao\NewRelicDao($serviceManager->get('NewRelicDaoConfig'));
                },
                'EventsDaoConfig' => function (ServiceManager $serviceManager) {
                        return $serviceManager->get('Config')['EventsDao'];
                },
                'EventsDao' => function (ServiceManager $serviceManager) {
                        return new Model\Dao\EventsDao($serviceManager->get('EventsDaoConfig'));
                },
                'GearmanDaoConfig' => function (ServiceManager $serviceManager) {
                        return $serviceManager->get('Config')['GearmanDao'];
                },
                'GearmanDao' => function (ServiceManager $serviceManager) {
                        return new Model\Dao\GearmanDao($serviceManager->get('GearmanDaoConfig'));
                },
                'RabbitMQDaoConfig' => function (ServiceManager $serviceManager) {
                    return $serviceManager->get('Config')['RabbitMQDao'];
                },
                'RabbitMQDao' => function (ServiceManager $serviceManager) {
                    return new Model\Dao\RabbitMQDao($serviceManager->get('RabbitMQDaoConfig'));
                },
                'WidgetFactory' => function (ServiceManager $serviceManager) {
                        return new Model\Widget\WidgetFactory($serviceManager->get('WidgetConfig'));
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
                        return $serviceManager->get('Config')['SplunkDao'];
                },
                'SplunkDao' => function (ServiceManager $serviceManager) {
                        return new Model\Dao\SplunkDao($serviceManager->get('SplunkDaoConfig'));
                },
                'TeamcityDaoConfig' => function (ServiceManager $serviceManager) {
                        return $serviceManager->get('Config')['TeamcityDao'];
                },
                'TeamcityDao' => function (ServiceManager $serviceManager) {
                        return new Model\Dao\TeamcityDao($serviceManager->get('TeamcityDaoConfig'));
                },
                'SmogDaoConfig' => function (ServiceManager $serviceManager) {
                        return $serviceManager->get('Config')['SmogDao'];
                },
                'SmogDao' => function (ServiceManager $serviceManager) {
                        return new Model\Dao\SmogDao($serviceManager->get('SmogDaoConfig'));
                },
                'HipChatDaoConfig' => function (ServiceManager $serviceManager) {
                        return $serviceManager->get('Config')['HipChatDao'];
                },
                'HipChatDao' => function (ServiceManager $serviceManager) {
                        return new Model\Dao\HipChatDao($serviceManager->get('HipChatDaoConfig'));
                },
                'BambooDaoConfig' => function (ServiceManager $serviceManager) {
                        return $serviceManager->get('Config')['BambooDao'];
                },
                'BambooDao' => function (ServiceManager $serviceManager) {
                        return new Model\Dao\BambooDao($serviceManager->get('BambooDaoConfig'));
                },
                'Bamboo4DaoConfig' => function (ServiceManager $serviceManager) {
                        return $serviceManager->get('Config')['Bamboo4Dao'];
                    },
                'Bamboo4Dao' => function (ServiceManager $serviceManager) {
                        return new Model\Dao\Bamboo4Dao($serviceManager->get('Bamboo4DaoConfig'));
                },
                'HttpStatusDao' => function () {
                        return new Model\Dao\HttpStatusDao(null);
                },
                'ImboDao' => function () {
                        return new Model\Dao\ImboDao(null);
                },
            ),
        );
    }

    /**
     * Include all files in modules config/autoload if the directory exists
     * @param  string $configPath Optional path to the configs path
     * @return array
     */
    private function autoloadConfigs($configPath = __DIR__)
    {
        $config = [];

        if (is_dir($configPath)) {
            $directory = new \RecursiveDirectoryIterator($configPath);
            $iterator = new \RecursiveIteratorIterator($directory);
            $regex = new \RegexIterator($iterator, '/^.+\.php$/i', \RecursiveRegexIterator::GET_MATCH);

            foreach ($regex as $file) {
                $singleConfigArray = require_once($file[0]);

                if (is_array($singleConfigArray)) {
                    $config = array_merge_recursive(
                        $config,
                        $singleConfigArray
                    );
                }
            }
        }

        return $config;
    }
}
