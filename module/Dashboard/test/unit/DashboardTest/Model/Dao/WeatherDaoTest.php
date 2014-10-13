<?php

namespace DashboardTest\Model\Dao;

use Dashboard\Model\Dao\WeatherDao;
use Zend\Uri\Uri;

class WeatherDaoTest extends \PHPUnit_Framework_TestCase
{
    public function testFetchForWeatherWidget()
    {
        $uri = new Uri();
        $params = [];
        $result = [];

        $observer = $this->getMockBuilder('Dashboard\\Model\\Dao\\WeatherDao')
            ->disableOriginalConstructor()
            ->setMethods(['request', 'getEndpointUrl'])
            ->setMockClassName('WeatherDao')
            ->getMock();

        $observer->expects($this->once())
            ->method('getEndpointUrl')
            ->with('fetchForWeatherWidget')
            ->willReturn($uri);

        $observer->expects($this->once())
            ->method('request')
            ->with($uri, $params)
            ->willReturn($result);

        $this->assertEquals($result, $observer->fetchForWeatherWidget($params));
    }
}