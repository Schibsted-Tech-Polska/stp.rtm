<?php
namespace Dashboard;

use Dashboard\Model\Dao\JenkinsDao;
use Dashboard\Model\Dao\NewRelicDao;

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
                'JenkinsDaoConfig' => function ($sm) {
                    return include('config/dao/JenkinsDao.config.php');
                },
                'JenkinsDao' => function ($sm) {
                    return new JenkinsDao($sm->get('JenkinsDaoConfig'));
                },
                'NewRelicDaoConfig' => function ($sm) {
                    return include('config/dao/NewRelicDao.config.php');
                },
                'NewRelicDao' => function ($sm) {
                    return new NewRelicDao($sm->get('NewRelicDaoConfig'));
                },
            ),
        );
    }
}
