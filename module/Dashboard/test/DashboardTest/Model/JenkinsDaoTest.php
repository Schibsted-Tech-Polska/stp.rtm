<?php
namespace DashboardTest\Model;

use Dashboard\Model\JenkinsDao;

class JenkinsDaoTest extends \PHPUnit_Framework_TestCase {
    /**
     * Testing proper Jenkins API URL - should return JSON
     */
    public function testProperApiUrl() {
        $response = JenkinsDao::getInstance()->request('http://ci.vgnett.no/view/VGTV/job/VGTV_front-end/api/json?pretty=true');

        $this->assertTrue(is_array($response), 'Testing proper API URL');
    }

    /**
     * Testing wrong API URL - will not return JSON
     * @expectedException \Zend\Json\Exception\RuntimeException
     */
    public function testImproperApiUrl() {
        JenkinsDao::getInstance()->request('http://ci.vgnett.no/');
    }
}