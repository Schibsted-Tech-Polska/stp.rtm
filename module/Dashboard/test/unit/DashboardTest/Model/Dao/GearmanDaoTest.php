<?php
namespace DashboardTest\Model\Dao;

use DashboardTest\Bootstrap;
use DashboardTest\DataProvider\GearmanDaoDataProvider;

class GearmanDaoTest extends AbstractDaoTestCase
{
    use GearmanDaoDataProvider;

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
     * @return \Dashboard\Model\Dao\JenkinsDao
     */
    protected function getTestedDao()
    {
        return Bootstrap::getServiceManager()->get('GearmanDao');
    }

    /**
     * Testing proper Jenkins API method - should return JSON parsed into array
     *
     * @dataProvider fetchJobsWithWorkersForQueueWidgetDataProvider
     */
    public function testFetchJobsWithWorkersForQueueWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao->fetchJobsWithWorkersForQueueWidget(['gearmanuiUrl' => 'http://gearmanui-url.com']);
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
        $this->testedDao->fetchJobsWithWorkersForQueueWidget();
    }
}
