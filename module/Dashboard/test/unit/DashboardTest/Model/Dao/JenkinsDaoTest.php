<?php
namespace DashboardTest\Model\Dao;

use DashboardTest\Bootstrap;

class JenkinsDaoTest extends AbstractDaoTestCase
{
    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     */
    protected function setUp()
    {
        parent::setUp();
        $this->testedDao->setDaoOptions([
            'params' => [
                'baseUrl' => 'http://ci.vgnett.no',
            ],
        ]);
    }

    /**
     * Testing proper Jenkins API method - should return JSON parsed into array
     *
     * @dataProvider fetchStatusForBuildWidgetDataProvider
     */
    public function testFetchStatusForBuildWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getConfig('handler')->append(
            \GuzzleHttp\Psr7\parse_response(file_get_contents($apiResponse))
        );

        $response = $this->testedDao->fetchStatusForBuildWidget([
            'view' => 'VGTV',
            'job' => 'VGTV_front-end',
        ]);

        $this->assertInternalType('array', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * Data provider for testFetchStatusForBuildWidget()
     * @return array
     */
    public function fetchStatusForBuildWidgetDataProvider()
    {
        return [
            'not building' => [
                '$apiResponse' =>
                    __DIR__ . '/../../Mock/Dao/Jenkins/fetchStatusForBuildWidgetResponse.txt',
                '$expectedDaoResponse' => [
                    'currentStatus' => 'SUCCESS',
                    'lastBuilt' => '2014-04-13 09:01:11',
                    'lastCommitter' => 'UNKNOWN',
                    'codeCoverage' => null,
                    'averageHealthScore' => 100,
                    'building' => false,
                    'percentDone' => 0,
                ],
            ],
        ];
    }

    /**
     * Testing proper Jenkins API method - should return JSON parsed into array
     *
     * @dataProvider fetchStatusForBuildWidgetBuildingDataProvider
     */
    public function testFetchStatusForBuildWidgetBuilding($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getConfig('handler')->append(
            \GuzzleHttp\Psr7\parse_response(file_get_contents($apiResponse)),
            \GuzzleHttp\Psr7\parse_response(file_get_contents(__DIR__ . '/../../Mock/Dao/Jenkins/fetchBuildStatusResponse.txt'))
        );

        $response = $this->testedDao->fetchStatusForBuildWidget([
            'view' => 'VGTV',
            'job' => 'VGTV_front-end',
        ]);

        $this->assertInternalType('array', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * Data provider for testFetchStatusForBuildWidget()
     * @return array
     */
    public function fetchStatusForBuildWidgetBuildingDataProvider()
    {
        return [
            'not building' => [
                '$apiResponse' =>
                    __DIR__ . '/../../Mock/Dao/Jenkins/fetchStatusForBuildWidgetBuildingResponse.txt',
                '$expectedDaoResponse' => [
                    'currentStatus' => null,
                    'lastBuilt' => '2014-05-22 09:34:58',
                    'lastCommitter' => 'arp',
                    'codeCoverage' => null,
                    'averageHealthScore' => 69.5,
                    'building' => true,
                    'percentDone' => 64,
                ],
            ],
        ];
    }

    /**
     * Executing fetch* method that is not defined in JenkinsDao - should throw an Exception
     * @expectedException \Dashboard\Model\Dao\Exception\FetchNotImplemented
     */
    public function testImproperApiMethod()
    {
        Bootstrap::getServiceManager()->get('JenkinsDao')->fetchImproperDataName([
            'view' => 'VGTV',
            'job' => 'VGTV_front-end',
        ]);
    }

    /**
     * Proper API method, not all required params given - should throw an Exception
     * @expectedException \Dashboard\Model\Dao\Exception\EndpointUrlNotAssembled
     */
    public function testNotAllRequiredParamsGiven()
    {
        Bootstrap::getServiceManager()->get('JenkinsDao')->fetchStatusForBuildWidget([
            'view' => 'VGTV',
        ]);
    }
}
