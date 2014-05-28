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
                'x-api-key' => 'foobar',
            ),
            'params' => array(
                'accountId' => '1111111',
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
            'appId' => '1111111',
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
     * Testing proper Jenkins API method - should return JSON parsed into array
     *
     * @dataProvider fetchFeRpmForNumberWidgetDataProvider
     */
    public function testFetchFeRpmForNumberWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchFeRpmForNumberWidget(array(
            'appId' => '1111111',
        ));

        $this->assertInternalType('numeric', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * Data provider for testFetchFeRpmForNumberWidget()
     * @return array
     */
    public function fetchFeRpmForNumberWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../../Mock/Dao/NewRelic/fetchFeRpmForNumberWidgetResponse.txt',
                '$expectedDaoResponse' => 7908.0,
            ],
        ];
    }

    /**
     * Testing proper Jenkins API method - should return JSON parsed into array
     *
     * @dataProvider fetchErrorRateForErrorWidgetDataProvider
     */
    public function testFetchErrorRateForErrorWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchErrorRateForErrorWidget(array(
            'appId' => '1111111',
        ));

        $this->assertInternalType('numeric', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * Data provider for testFetchErrorRateForErrorWidget()
     * @return array
     */
    public function fetchErrorRateForErrorWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => 0,
            ],
        ];
    }


    /**
     * Testing proper Jenkins API method - should return JSON parsed into array
     *
     * @dataProvider fetchApdexForNumberWidgetDataProvider
     */
    public function testFetchApdexForNumberWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchApdexForNumberWidget(array(
            'appId' => '1111111',
        ));

        $this->assertInternalType('numeric', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * Data provider for testFetchErrorRateForErrorWidget()
     * @return array
     */
    public function fetchApdexForNumberWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => 0.99,
            ],
        ];
    }

    /**
     * Testing proper Jenkins API method - should return JSON parsed into array
     *
     * @dataProvider fetchApdexForIncrementalGraphWidgetDataProvider
     */
    public function testFetchApdexForIncrementalGraphWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchApdexForIncrementalGraphWidget(array(
            'appId' => '1111111',
        ));

        $this->assertInternalType('array', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * Data provider for testFetchErrorRateForErrorWidget()
     * @return array
     */
    public function fetchApdexForIncrementalGraphWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => [
                    'x' => 1401270766,
                    'y' => "0.99",
                    'events' => [],
                ]
            ],
        ];
    }

    /**
     * Testing proper Jenkins API method - should return JSON parsed into array
     *
     * @dataProvider fetchCpuUsageForNumberWidgetDataProvider
     */
    public function testFetchCpuUsageForNumberWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchCpuUsageForNumberWidget(array(
            'appId' => '1111111',
        ));

        $this->assertInternalType('numeric', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * Data provider for testFetchErrorRateForErrorWidget()
     * @return array
     */
    public function fetchCpuUsageForNumberWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../../Mock/Dao/NewRelic/fetchCpuUsageForNumberWidgetResponse.txt',
                '$expectedDaoResponse' => 26.8,
            ],
        ];
    }

    /**
     * Testing proper Jenkins API method - should return JSON parsed into array
     *
     * @dataProvider fetchAverageResponseTimeForNumberWidgetDataProvider
     */
    public function testFetchAverageResponseTimeForNumberWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchAverageResponseTimeForNumberWidget(array(
            'appId' => '1111111',
        ));

        $this->assertInternalType('numeric', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * Data provider for testFetchErrorRateForErrorWidget()
     * @return array
     */
    public function fetchAverageResponseTimeForNumberWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../../Mock/Dao/NewRelic/fetchAverageResponseTimeForNumberWidgetResponse.txt',
                '$expectedDaoResponse' => 135.0,
            ],
        ];
    }

//


    /**
     * Executing fetch* method that is not defined in JenkinsDao - should throw an Exception
     * @expectedException \Dashboard\Model\Dao\Exception\FetchNotImplemented
     */
    public function testImproperApiMethod()
    {
        $this->testedDao->fetchImproperDataName(array(
            'appId' => '1111111',
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
