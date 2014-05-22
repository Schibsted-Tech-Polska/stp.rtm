<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace DashboardTest\Model\Dao;

use DashboardTest\Bootstrap;

class NewRelicDaoTest extends AbstractDaoTestCase
{
    /**
     * @return \Dashboard\Model\Dao\NewRelicDao
     */
    protected function getTestedDao()
    {
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
     *
     * @dataProvider fetchRpmForNumberWidgetDataProvider
     */
    public function testFetchRpmForNumberWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchRpmForNumberWidget(array(
            'appId' => '1290733',
        ));

        $this->assertInternalType('numeric', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * Data provider for testFetchStatusForBuildWidget()
     * @return array
     */
    public function fetchRpmForNumberWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../../Mock/Dao/NewRelic/fetchRpmForNumberWidgetResponse.txt',
                '$expectedDaoResponse' => 775,
            ],
        ];
    }

    /**
     * Executing fetch* method that is not defined in JenkinsDao - should throw an Exception
     * @expectedException \Dashboard\Model\Dao\Exception\FetchNotImplemented
     */
    public function testImproperApiMethod()
    {
        $this->testedDao->fetchImproperDataName(array(
            'appId' => '1290733',
        ));
    }

    /**
     * Proper API method, not all required params given - should throw an Exception
     * @expectedException \Dashboard\Model\Dao\Exception\EndpointUrlNotAssembled
     */
    public function testNotAllRequiredParamsGiven()
    {
        $this->testedDao->fetchErrorRateForErrorWidget();
    }
}
