<?php
namespace DashboardTest\Model;

use Dashboard\Model\Dao\DaoFactory;
use DashboardTest\Bootstrap;

class JenkinsDaoTest extends \PHPUnit_Framework_TestCase {
    /**
     * Testing proper Jenkins API URL - should return JSON
     */
    public function testProperApiUrl() {
        $response = Bootstrap::getServiceManager()->get('JenkinsDao')->fetchStatus(array(
            'view' => 'VGTV',
            'job'  => 'VGTV_front-end',
        ));

        $this->assertTrue(is_array($response), 'Testing proper API URL');
    }

    /**
     * Testing wrong API URL - will not return JSON
     * @expectedException \Zend\Json\Exception\RuntimeException
     */
    public function testImproperApiUrl() {
        Bootstrap::getServiceManager()->get('JenkinsDao')->request('http://ci.vgnett.no/');
    }
}