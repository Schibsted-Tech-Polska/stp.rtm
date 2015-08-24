<?php
namespace DashboardTest\Model\Dao;

use DashboardTest\DataProvider\RabbitMQDaoDataProvider;

class RabbitMQDaoTest extends AbstractDaoTestCase
{
    use RabbitMQDaoDataProvider;

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
     * @dataProvider fetchQueuesForRabbitMQWidgetDataProvider
     */
    public function testFetchQueuesForRabbitMQWidget($apiResponse, $expectedDaoResponse)
    {
        $this->testedDao->getDataProvider()->getAdapter()->setResponse(file_get_contents($apiResponse));

        $response = $this->testedDao
            ->fetchQueuesForRabbitMQWidget([
                'rabbitMQUrl' => 'http://rabbitmq-url.com',
                'vhost' => 'integrator',
                'ignoreQueues' => ['.*testing.*'],
                'queueNameParser' => function ($queueName) {
                    return $queueName;
                },
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
        $this->testedDao->fetchQueuesForRabbitMQWidget();
    }
}
