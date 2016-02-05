<?php
namespace DashboardTest\Model\Dao;

use DashboardTest\DataProvider\Bamboo4DaoDataProvider;

class Bamboo4DaoTest extends AbstractBambooDao
{
    use Bamboo4DaoDataProvider;

    protected function setUp()
    {
        parent::setUp();
        $this->testedDao->setDaoOptions([
            'params' => [
                'baseUrl' => 'http://bamboo.aftonbladet.se:8085',
            ],
        ]);
    }


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
}
