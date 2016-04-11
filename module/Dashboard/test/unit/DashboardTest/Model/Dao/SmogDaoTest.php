<?php
namespace DashboardTest\Model\Dao;

use DashboardTest\DataProvider\SmogDaoDataProvider;

class SmogDaoTest extends AbstractDaoTestCase
{
    use SmogDaoDataProvider;

    /**
     * @dataProvider fetchForSmogWidgetDataProvider
     */
    public function testFetchForSmogWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getConfig('handler')->append(
            \GuzzleHttp\Psr7\parse_response(file_get_contents($apiResponse))
        );

        $response = $this->testedDao->fetchForSmogWidget();
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
}
