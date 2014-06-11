<?php
namespace DashboardTest\Model\Dao;

use DashboardTest\DataProvider\BambooDaoDataProvider;

class BambooDaoTest extends AbstractDaoTestCase
{
    use BambooDaoDataProvider;

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
     * @dataProvider fetchStatusForBuildWidgetDataProvider
     */
    public function testFetchStatusForBuildWidget(
        $runningBuildsResponse,
        $fetchStatusForBuildWidgetResponse,
        $expectedDaoResponse
    ) {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(
            file_get_contents($runningBuildsResponse)
        );
        $this->testedDao->getDataProvider()->getAdapter()->addResponse(
            file_get_contents($fetchStatusForBuildWidgetResponse)
        );

        $response = $this->testedDao->fetchStatusForBuildWidget(['project' => 'foobar', 'plan' => 'awesome']);
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
        $this->testedDao->fetchStatusForBuildWidget();
    }
}
