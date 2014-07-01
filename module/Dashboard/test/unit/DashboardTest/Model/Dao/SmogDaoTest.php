<?php
namespace DashboardTest\Model\Dao;

use DashboardTest\DataProvider\SmogDaoDataProvider;

class SmogDaoTest extends AbstractDaoTestCase
{
    use SmogDaoDataProvider;

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
     * @dataProvider fetchForSmogWidgetDataProvider
     */
    public function testFetchForSmogWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

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
