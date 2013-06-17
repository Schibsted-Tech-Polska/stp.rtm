<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace DashboardTest\Model;

use DashboardTest\Bootstrap;

class NewRelicDaoTest extends \PHPUnit_Framework_TestCase {

    /**
     * @return \Dashboard\Model\Dao\NewRelicDao
     */
    protected function getConfiguredDao() {
        $dao = Bootstrap::getServiceManager()->get('NewRelicDao');
        $dao->setDaoOptions(array(
            'headers' => array(
                'x-api-key' => '0116c7512e1efa28a39116312e9640edb90f1f52bb6ab30',
            ),
            'params' => array(
                'accountId' => '100366',
            ),
        ));

        return $dao;
    }
    /**
     * Testing proper Jenkins API method - should return JSON parsed into array
     */
    public function testProperApiUrl() {
        $response = $this->getConfiguredDao()->fetchRpmForNumberWidget(array(
            'appId' => '1290733',
        ));

        $this->assertTrue(is_numeric($response), 'Testing proper API URL');
    }

    /**
     * Executing fetch* method that is not defined in JenkinsDao - should throw an Exception
     * @expectedException \Dashboard\Model\Dao\Exception\FetchNotImplemented
     */
    public function testImproperApiMethod() {
        $this->getConfiguredDao()->fetchImproperDataName(array(
            'appId' => '1290733',
        ));
    }

    /**
     * Proper API method, not all required params given - should throw an Exception
     * @expectedException \Dashboard\Model\Dao\Exception\EndpointUrlNotAssembled
     */
    public function testNotAllRequiredParamsGiven() {
        $this->getConfiguredDao()->fetchErrorRateForNumberWidget();
    }
}