<?php
namespace DashboardTest\Model;

use Dashboard\Model\JenkinsDao;

class JenkinsDaoTest extends \PHPUnit_Framework_TestCase {

    public function testProperApiUrl() {
        $response = JenkinsDao::getInstance()->request('http://ci.vgnett.no/view/VGTV/job/VGTV_front-end/api/json?pretty=true');

        $this->assertTrue(is_array($response), 'Testing proper API URL');
    }

    public function testImproperApiUrl() {
        $this->setExpectedException('Zend\Json\Exception\RuntimeException');
        JenkinsDao::getInstance()->request('http://ci.vgnett.no/');
    }

}