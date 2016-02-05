<?php
namespace DashboardTest\Model\Dao;

use DashboardTest\DataProvider\HipChatDaoDataProvider;

class HipChatDaoTest extends AbstractDaoTestCase
{
    use HipChatDaoDataProvider;

    /**
     * @dataProvider fetchListRecentMessagesForMessagesWidgetDataProvider
     */
    public function testFetchListRecentMessagesForMessagesWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getConfig('handler')->append(
            \GuzzleHttp\Psr7\parse_response(file_get_contents($apiResponse))
        );
        $this->testedDao->setDaoOptions(['params' => ['auth_token' => 'qwertyuiop']]);

        $response = $this->testedDao->fetchListRecentMessagesForMessagesWidget(['room' => 'foobar', 'limit' => 10]);
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
        $this->testedDao->fetchListRecentMessagesForMessagesWidget();
    }
}
