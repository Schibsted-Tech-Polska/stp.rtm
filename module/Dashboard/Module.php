<?php
namespace Dashboard;

use Dashboard\Model\Dao\GraphiteDao;
use Dashboard\Model\Dao\HerokuStatusDao;
use Dashboard\Model\Dao\SupervisordDao;
use Dashboard\Model\Dao\WeatherDao;
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
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return [
            'factories' => [
                // Common services
                'WidgetFactory' => function (ServiceManager $serviceManager) {
                    return new Model\Widget\WidgetFactory($serviceManager->get('Config')['widgetsConfig']);
                },
                'CacheAdapter' => function ($serviceManager) {
                    return new Memcached($serviceManager->get('CacheAdapterOptions'));
                },
                'CacheAdapterOptions' => function ($serviceManager) {
                    return new MemcachedOptions($serviceManager->get('Config')['dashboardCache']);
                },

                // DAO classes
                'JenkinsDao' => function (ServiceManager $serviceManager) {
                    return new Model\Dao\JenkinsDao($serviceManager->get('Config')['JenkinsDao']);
                },
                'NewRelicDao' => function (ServiceManager $serviceManager) {
                    return new Model\Dao\NewRelicDao($serviceManager->get('Config')['NewRelicDao']);
                },
                'EventsDao' => function (ServiceManager $serviceManager) {
                    return new Model\Dao\EventsDao($serviceManager->get('Config')['EventsDao']);
                },
                'GearmanDao' => function (ServiceManager $serviceManager) {
                    return new Model\Dao\GearmanDao($serviceManager->get('Config')['GearmanDao']);
                },
                'RabbitMQDao' => function (ServiceManager $serviceManager) {
                    return new Model\Dao\RabbitMQDao($serviceManager->get('Config')['RabbitMQDao']);
                },
                'HadoopDao' => function (ServiceManager $serviceManager) {
                    return new Model\Dao\HadoopDao($serviceManager->get('Config')['HadoopDao']);
                },
                'EyeDao' => function (ServiceManager $serviceManager) {
                    return new Model\Dao\EyeDao($serviceManager->get('Config')['EyeDao']);
                },
                'SplunkDao' => function (ServiceManager $serviceManager) {
                    return new Model\Dao\SplunkDao($serviceManager->get('Config')['SplunkDao']);
                },
                'TeamcityDao' => function (ServiceManager $serviceManager) {
                    return new Model\Dao\TeamcityDao($serviceManager->get('Config')['TeamcityDao']);
                },
                'SmogDao' => function (ServiceManager $serviceManager) {
                    return new Model\Dao\SmogDao($serviceManager->get('Config')['SmogDao']);
                },
                'HipChatDao' => function (ServiceManager $serviceManager) {
                    return new Model\Dao\HipChatDao($serviceManager->get('Config')['HipChatDao']);
                },
                'SlackDao' => function (ServiceManager $serviceManager) {
                    return new Model\Dao\SlackDao($serviceManager->get('Config')['SlackDao']);
                },
                'BambooDao' => function (ServiceManager $serviceManager) {
                    return new Model\Dao\BambooDao($serviceManager->get('Config')['BambooDao']);
                },
                'Bamboo4Dao' => function (ServiceManager $serviceManager) {
                    return new Model\Dao\Bamboo4Dao($serviceManager->get('Config')['Bamboo4Dao']);
                },
                'WeatherDao' => function (ServiceManager $serviceManager) {
                    return new WeatherDao($serviceManager->get('Config')['WeatherDao']);
                },
                'HerokuStatusDao' => function (ServiceManager $serviceManager) {
                    return new HerokuStatusDao($serviceManager->get('Config')['HerokuStatusDao']);
                },
                'GraphiteDao' => function (ServiceManager $serviceManager) {
                    return new GraphiteDao($serviceManager->get('Config')['GraphiteDao']);
                },
                'SupervisordDao' => function (ServiceManager $serviceManager) {
                    return new SupervisordDao($serviceManager->get('Config')['SupervisordDao']);
                },
                'GoCDDao' => function (ServiceManager $serviceManager) {
                    return new Model\Dao\GoCDDao($serviceManager->get('Config')['GoCDDao']);
                },
            ],
        ];
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
