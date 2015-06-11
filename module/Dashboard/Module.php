<?php
namespace Dashboard;

use Dashboard\Model\Dao\GraphiteDao;
use Dashboard\Model\Dao\HerokuStatusDao;
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
                'HadoopDaoConfig' => function (ServiceManager $serviceManager) {
                    return $serviceManager->get('Config')['HadoopDao'];
                },
                'HadoopDao' => function (ServiceManager $serviceManager) {
                    return new Model\Dao\HadoopDao($serviceManager->get('HadoopDaoConfig'));
                },
                'EyeDaoConfig' => function (ServiceManager $serviceManager) {
                    return $serviceManager->get('Config')['EyeDao'];
                },
                'EyeDao' => function (ServiceManager $serviceManager) {
                    return new Model\Dao\EyeDao($serviceManager->get('EyeDaoConfig'));
                },
                'WidgetFactory' => function (ServiceManager $serviceManager) {
                    return new Model\Widget\WidgetFactory($serviceManager->get('WidgetConfig'));
                },
                'CacheAdapter' => function ($serviceManager) {
                    return new Memcached($serviceManager->get('CacheAdapterOptions'));
                },
                'CacheAdapterOptions' => function ($serviceManager) {
                    return new MemcachedOptions($serviceManager->get('Config')['dashboardCache']);
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
                'SlackDaoConfig' => function (ServiceManager $serviceManager) {
                    return $serviceManager->get('Config')['SlackDao'];
                },
                'SlackDao' => function (ServiceManager $serviceManager) {
                    return new Model\Dao\SlackDao($serviceManager->get('SlackDaoConfig'));
                },
                'Parsedown' => function (ServiceManager $serviceManager) {
                    return new \Parsedown();
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
                'WeatherDaoConfig' => function (ServiceManager $serviceManager) {
                    return $serviceManager->get('Config')['WeatherDao'];
                },
                'WeatherDao' => function (ServiceManager $serviceManager) {
                    return new WeatherDao($serviceManager->get('WeatherDaoConfig'));
                },
                'HerokuStatusDaoConfig' => function (ServiceManager $serviceManager) {
                    return $serviceManager->get('Config')['HerokuStatusDao'];
                },
                'HerokuStatusDao' => function (ServiceManager $serviceManager) {
                    return new HerokuStatusDao($serviceManager->get('HerokuStatusDaoConfig'));
                },
                'GraphiteDao' => function (ServiceManager $serviceManager) {
                    return new GraphiteDao($serviceManager->get('GraphiteDaoConfig'));
                },
                'GraphiteDaoConfig' => function (ServiceManager $serviceManager) {
                    return $serviceManager->get('Config')['GraphiteDao'];
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
