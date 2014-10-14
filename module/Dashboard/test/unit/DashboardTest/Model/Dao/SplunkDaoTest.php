<?php
namespace DashboardTest\Model\Dao;

use DashboardTest\DataProvider\SplunkDaoDataProvider;

class SplunkDaoTest extends AbstractDaoTestCase
{
    use SplunkDaoDataProvider;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     */
    protected function setUp()
    {
        parent::setUp();
        $this->testedDao->getDataProvider()->setAdapter(new \Zend\Http\Client\Adapter\Test());
    }

    /**
     * @dataProvider fetchFivehundredsForAlertWidgetDataProvider
     */
    public function testFetchFivehundredsForAlertWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->setDaoOptions([
            'params' => [
                'baseUrl' => 'https://mother.int.vgnett.no:8089',
            ],
            'auth' => [
                'username' => 'foo',
                'password' => 'bar',
            ]
        ]);
        $adapter = $this->testedDao->getDataProvider()->getAdapter();
        $responseString = file_get_contents($apiResponse);
        $adapter->setResponse($responseString);
        $response = $this->testedDao->fetchFivehundredsForAlertWidget(['config' => [
            'search' => 'search sourcetype=apache_access NOT(toolbox) host=godt-web-* OR host=red-web-* status=500 | stats count latest(_time) as latestTime by url | sort -count | head 5',
            'earliest_time' => '-1h',
            'latest' => 'now',
            'output_mode' => 'json_cols',
        ]]);
        $this->assertInternalType('array', $response);
        $this->assertEquals($expectedDaoResponse, $response);

    }

    /**
     * Executing fetch* method that is not defined in JenkinsDao - should throw an Exception
     * @expectedException \Dashboard\Model\Dao\Exception\FetchNotImplemented
     */
    public function testImproperApiMethod()
    {
        $this->testedDao->fetchImproperDataName();
    }

    /**
     * Proper API method, not all required params given - should throw an Exception
     * @expectedException \Dashboard\Model\Dao\Exception\EndpointUrlNotAssembled
     */
    public function testNotAllRequiredParamsGiven()
    {
        $this->testedDao->fetchFivehundredsForAlertWidget();
    }
}
