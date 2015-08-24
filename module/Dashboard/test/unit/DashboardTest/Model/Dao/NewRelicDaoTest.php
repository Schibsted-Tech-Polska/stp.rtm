<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace DashboardTest\Model\Dao;

use DashboardTest\DataProvider\NewRelicDaoDataProvider;

class NewRelicDaoTest extends AbstractDaoTestCase
{
    use NewRelicDaoDataProvider;

    /**
     * @return \Dashboard\Model\Dao\NewRelicDao
     */
    protected function getTestedDao()
    {
        $dao = parent::getTestedDao();
        $dao->setDaoOptions([
            'headers' => [
                'x-api-key' => 'foobar',
            ],
            'params' => [
                'accountId' => '1111111',
            ],
        ]);

        return $dao;
    }

    /**
     * @dataProvider fetchRpmForNumberWidgetDataProvider
     */
    public function testFetchRpmForNumberWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchRpmForNumberWidget([
            'appId' => '1111111',
        ]);

        $this->assertInternalType('numeric', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @dataProvider fetchFeRpmForNumberWidgetDataProvider
     */
    public function testFetchFeRpmForNumberWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchFeRpmForNumberWidget([
            'appId' => '1111111',
        ]);

        $this->assertInternalType('numeric', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @dataProvider fetchErrorRateForErrorWidgetDataProvider
     */
    public function testFetchErrorRateForErrorWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchErrorRateForErrorWidget([
            'appId' => '1111111',
        ]);

        $this->assertInternalType('numeric', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @dataProvider fetchApdexForNumberWidgetDataProvider
     */
    public function testFetchApdexForNumberWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchApdexForNumberWidget([
            'appId' => '1111111',
        ]);

        $this->assertInternalType('numeric', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @dataProvider fetchApdexForIncrementalGraphWidgetDataProvider
     */
    public function testFetchApdexForIncrementalGraphWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchApdexForIncrementalGraphWidget([
            'appId' => '1111111',
        ]);

        $this->assertInternalType('array', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @dataProvider fetchCpuUsageForNumberWidgetDataProvider
     */
    public function testFetchCpuUsageForNumberWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchCpuUsageForNumberWidget([
            'appId' => '1111111',
        ]);

        $this->assertInternalType('numeric', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @dataProvider fetchAverageResponseTimeForNumberWidgetDataProvider
     */
    public function testFetchAverageResponseTimeForNumberWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchAverageResponseTimeForNumberWidget([
            'appId' => '1111111',
        ]);

        $this->assertInternalType('numeric', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @dataProvider fetchMemoryForNumberWidgetDataProvider
     */
    public function testFetchMemoryForNumberWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchMemoryForNumberWidget([
            'appId' => '1111111',
        ]);

        $this->assertInternalType('numeric', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @dataProvider fetchMemoryForIncrementalGraphWidgetDataProvider
     */
    public function testFetchMemoryForIncrementalGraphWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchMemoryForIncrementalGraphWidget([
            'appId' => '1111111',
        ]);

        $this->assertInternalType('array', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @dataProvider fetchCpuFromThresholdForNumberWidgetDataProvider
     */
    public function testFetchCpuFromThresholdForNumberWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchCpuFromThresholdForNumberWidget([
            'appId' => '1111111',
        ]);

        $this->assertInternalType('numeric', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @dataProvider fetchCpuFromThresholdForIncrementalGraphWidgetDataProvider
     */
    public function testFetchCpuFromThresholdForIncrementalGraphWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchCpuFromThresholdForIncrementalGraphWidget([
            'appId' => '1111111',
        ]);

        $this->assertInternalType('array', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @dataProvider fetchDBFromThresholdForNumberWidgetDataProvider
     */
    public function testFetchDBFromThresholdForNumberWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchDBFromThresholdForNumberWidget([
            'appId' => '1111111',
        ]);

        $this->assertInternalType('numeric', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @dataProvider fetchDBFromThresholdForIncrementalGraphWidgetDataProvider
     */
    public function testFetchDBFromThresholdForIncrementalGraphWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchDBFromThresholdForIncrementalGraphWidget([
            'appId' => '1111111',
        ]);

        $this->assertInternalType('array', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @dataProvider fetchThroughputFromThresholdForNumberWidgetDataProvider
     */
    public function testFetchThroughputFromThresholdForNumberWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchThroughputFromThresholdForNumberWidget([
            'appId' => '1111111',
        ]);

        $this->assertInternalType('numeric', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @dataProvider fetchThroughputFromThresholdForIncrementalGraphWidgetDataProvider
     */
    public function testFetchThroughputFromThresholdForIncrementalGraphWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchThroughputFromThresholdForIncrementalGraphWidget([
            'appId' => '1111111',
        ]);

        $this->assertInternalType('array', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @dataProvider fetchResponseTimeFromThresholdForNumberWidgetDataProvider
     */
    public function testFetchResponseTimeFromThresholdForNumberWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchResponseTimeFromThresholdForNumberWidget([
            'appId' => '1111111',
        ]);

        $this->assertInternalType('numeric', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @dataProvider fetchResponseTimeFromThresholdForIncrementalGraphWidgetDataProvider
     */
    public function testFetchResponseTimeFromThresholdForIncrementalGraphWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchResponseTimeFromThresholdForIncrementalGraphWidget([
            'appId' => '1111111',
        ]);

        $this->assertInternalType('array', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @dataProvider fetchEventsDataProvider
     */
    public function testFetchEvents($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchEvents([
            'appId' => '1111111',
            'feed' => '2222',
            'eventType' => 'deployment',
        ]);

        $this->assertInternalType('array', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * @dataProvider fetchThresholdDataProvider
     */
    public function testFetchThreshold($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchThreshold([
            'appId' => '1111111',
            'metric' => 'Apdex',
        ]);

        $this->assertInternalType('array', $response);
        $this->assertEquals($expectedDaoResponse, $response);
    }

    /**
     * Executing fetch* method that is not defined in JenkinsDao - should throw an Exception
     * @expectedException \Dashboard\Model\Dao\Exception\FetchNotImplemented
     */
    public function testImproperApiMethod()
    {
        $this->testedDao->fetchImproperDataName([
            'appId' => '1111111',
        ]);
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
