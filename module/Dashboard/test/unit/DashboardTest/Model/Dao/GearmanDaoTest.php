<?php
namespace DashboardTest\Model\Dao;

use DashboardTest\DataProvider\GearmanDaoDataProvider;

class GearmanDaoTest extends AbstractDaoTestCase
{
    use GearmanDaoDataProvider;

    /**
     * @dataProvider fetchJobsWithWorkersForGearmanWidgetDataProvider
     */
    public function testFetchJobsWithWorkersForGearmanWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getConfig('handler')->append(
            \GuzzleHttp\Psr7\parse_response(file_get_contents($apiResponse))
        );

        $response = $this->testedDao
            ->fetchJobsWithWorkersForGearmanWidget([
                'gearmanuiUrl' => 'http://gearmanui-url.com',
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
        $this->testedDao->fetchImproperDataName();
    }

    /**
     * Proper API method, not all required params given - should throw an Exception
     * @expectedException \Dashboard\Model\Dao\Exception\EndpointUrlNotAssembled
     */
    public function testNotAllRequiredParamsGiven()
    {
        $this->testedDao->fetchJobsWithWorkersForGearmanWidget();
    }
}
