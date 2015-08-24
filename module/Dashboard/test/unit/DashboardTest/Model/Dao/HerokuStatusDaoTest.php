<?php

namespace DashboardTest\Model\Dao;

use Zend\Uri\Uri;

class HerokuStatusDaoTest extends \PHPUnit_Framework_TestCase
{
    public function testFetchForHerokuStatusWidget()
    {
        $uri = new Uri();
        $params = [];
        $result = [];

        $observer = $this->getMockBuilder('Dashboard\\Model\\Dao\\HerokuStatusDao')
            ->disableOriginalConstructor()
            ->setMethods(['request', 'getEndpointUrl'])
            ->setMockClassName('HerokuStatusDao')
            ->getMock();

        $observer->expects($this->once())
            ->method('getEndpointUrl')
            ->with('fetchForHerokuStatusWidget')
            ->willReturn($uri);

        $observer->expects($this->once())
            ->method('request')
            ->with($uri, $params)
            ->willReturn($result);

        $this->assertEquals($result, $observer->fetchForHerokuStatusWidget($params));
    }
}
