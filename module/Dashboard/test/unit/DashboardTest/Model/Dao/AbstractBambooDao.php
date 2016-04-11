<?php
namespace DashboardTest\Model\Dao;

use DashboardTest\DataProvider\BambooDaoDataProvider;

abstract class AbstractBambooDao extends AbstractDaoTestCase
{
    use BambooDaoDataProvider;

    /**
     * @dataProvider fetchStatusForBuildWidgetDataProvider
     */
    public function testFetchStatusForBuildWidget(
        $runningBuildsResponse,
        $fetchStatusForBuildWidgetResponse,
        $expectedDaoResponse
    ) {
        $this->testedDao->getDataProvider()->getConfig('handler')->append(
            \GuzzleHttp\Psr7\parse_response(file_get_contents($runningBuildsResponse)),
            \GuzzleHttp\Psr7\parse_response(file_get_contents($fetchStatusForBuildWidgetResponse))
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
