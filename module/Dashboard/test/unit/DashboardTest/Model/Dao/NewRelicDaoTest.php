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

    /**
     * Testing proper Jenkins API method - should return JSON parsed into array
     *
     * @dataProvider fetchMemoryForNumberWidgetDataProvider
     */
    public function testFetchMemoryForNumberWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchMemoryForNumberWidget(array(
            'appId' => '1111111',
        ));

        $this->assertInternalType('numeric', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * Data provider for testFetchErrorRateForErrorWidget()
     * @return array
     */
    public function fetchMemoryForNumberWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => 87.8,
            ],
        ];
    }

    /**
     * Testing proper Jenkins API method - should return JSON parsed into array
     *
     * @dataProvider fetchMemoryForIncrementalGraphWidgetDataProvider
     */
    public function testFetchMemoryForIncrementalGraphWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchMemoryForIncrementalGraphWidget(array(
            'appId' => '1111111',
        ));

        $this->assertInternalType('array', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * Data provider for testFetchErrorRateForErrorWidget()
     * @return array
     */
    public function fetchMemoryForIncrementalGraphWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => [
                    'x' => 1401270766,
                    'y' => "87.8",
                    'events' => [],
                ],
            ],
        ];
    }

    /**
     * @dataProvider fetchCpuFromThresholdForNumberWidgetDataProvider
     */
    public function testFetchCpuFromThresholdForNumberWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchCpuFromThresholdForNumberWidget(array(
            'appId' => '1111111',
        ));

        $this->assertInternalType('numeric', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @return array
     */
    public function fetchCpuFromThresholdForNumberWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => 15.8,
            ],
        ];
    }

    /**
     * Testing proper Jenkins API method - should return JSON parsed into array
     *
     * @dataProvider fetchCpuFromThresholdForIncrementalGraphWidgetDataProvider
     */
    public function testFetchCpuFromThresholdForIncrementalGraphWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchCpuFromThresholdForIncrementalGraphWidget(array(
            'appId' => '1111111',
        ));

        $this->assertInternalType('array', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * Data provider for testFetchErrorRateForErrorWidget()
     * @return array
     */
    public function fetchCpuFromThresholdForIncrementalGraphWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => [
                    'x' => 1401270766,
                    'y' => "15.8",
                    'events' => [],
                ],
            ],
        ];
    }

    /**
     * @dataProvider fetchDBFromThresholdForNumberWidgetDataProvider
     */
    public function testFetchDBFromThresholdForNumberWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchDBFromThresholdForNumberWidget(array(
            'appId' => '1111111',
        ));

        $this->assertInternalType('numeric', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @return array
     */
    public function fetchDBFromThresholdForNumberWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => 1.76,
            ],
        ];
    }

    /**
     * @dataProvider fetchDBFromThresholdForIncrementalGraphWidgetDataProvider
     */
    public function testFetchDBFromThresholdForIncrementalGraphWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchDBFromThresholdForIncrementalGraphWidget(array(
            'appId' => '1111111',
        ));

        $this->assertInternalType('array', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @return array
     */
    public function fetchDBFromThresholdForIncrementalGraphWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => [
                    'x' => 1401270766,
                    'y' => "1.76",
                    'events' => [],
                ],
            ],
        ];
    }

    /**
     * @dataProvider fetchThroughputFromThresholdForNumberWidgetDataProvider
     */
    public function testFetchThroughputFromThresholdForNumberWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchThroughputFromThresholdForNumberWidget(array(
            'appId' => '1111111',
        ));

        $this->assertInternalType('numeric', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @return array
     */
    public function fetchThroughputFromThresholdForNumberWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => 252,
            ],
        ];
    }

    /**
     * @dataProvider fetchThroughputFromThresholdForIncrementalGraphWidgetDataProvider
     */
    public function testFetchThroughputFromThresholdForIncrementalGraphWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchThroughputFromThresholdForIncrementalGraphWidget(array(
            'appId' => '1111111',
        ));

        $this->assertInternalType('array', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @return array
     */
    public function fetchThroughputFromThresholdForIncrementalGraphWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => [
                    'x' => 1401270766,
                    'y' => "252",
                    'events' => [],
                ],
            ],
        ];
    }

    /**
     * @dataProvider fetchResponseTimeFromThresholdForNumberWidgetDataProvider
     */
    public function testFetchResponseTimeFromThresholdForNumberWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchResponseTimeFromThresholdForNumberWidget(array(
            'appId' => '1111111',
        ));

        $this->assertInternalType('numeric', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @return array
     */
    public function fetchResponseTimeFromThresholdForNumberWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => 134,
            ],
        ];
    }

    /**
     * @dataProvider fetchResponseTimeFromThresholdForIncrementalGraphWidgetDataProvider
     */
    public function testFetchResponseTimeFromThresholdForIncrementalGraphWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchResponseTimeFromThresholdForIncrementalGraphWidget(array(
            'appId' => '1111111',
        ));

        $this->assertInternalType('array', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @return array
     */
    public function fetchResponseTimeFromThresholdForIncrementalGraphWidgetDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../../Mock/Dao/NewRelic/fetchThresholdValuesResponse.txt',
                '$expectedDaoResponse' => [
                    'x' => 1401270766,
                    'y' => "134",
                    'events' => [],
                ],
            ],
        ];
    }

    /**
     * @dataProvider fetchEventsDataProvider
     */
    public function testFetchEvents($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchEvents(array(
            'appId' => '1111111',
            'feed' => '2222',
            'eventType' => 'deployment',
        ));

        $this->assertInternalType('array', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @return array
     */
    public function fetchEventsDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../../Mock/Dao/NewRelic/fetchEventsResponse.txt',
                '$expectedDaoResponse' => [
                    [
                        'title' => 'michald deployed revision 4701',
                        'date' => '1400765104',
                        'type' => 'deployment'
                    ],
                    [
                        'title' => 'anmaciur deployed revision 4697',
                        'date' => '1400587640',
                        'type' => 'deployment'
                    ],
                ],
            ],
        ];
    }

    /**
     * @dataProvider fetchThresholdDataProvider
     */
    public function testFetchThreshold($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchThreshold(array(
            'appId' => '1111111',
            'metric' => 'Apdex',
        ));

        $this->assertInternalType('array', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @return array
     */
    public function fetchThresholdDataProvider()
    {
        return [
            'proper result' => [
                '$apiResponse' =>
                    __DIR__ . '/../../Mock/Dao/NewRelic/fetchThresholdResponse.txt',
                '$expectedDaoResponse' => [
                    'id' => '500035',
                    'type' => 'Apdex',
                    'caution-value' => '0.85',
                    'critical-value' => '0.7',
                    'url' => 'https://rpm.newrelic.com/api/v1/accounts/100366/applications/1716240/thresholds/500035',
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
