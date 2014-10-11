<?php

namespace DashboardTest\Model\Dao;

use Dashboard\Model\Dao\WeatherDao;

class WeatherDaoTest extends AbstractDaoTestCase
{
    public function testFetchForWeatherWidget()
    {
        $params = [];

        $observer = $this->getMock(WeatherDao::class, ['fetchWeather']);
        $observer->expects($this->once())
            ->method('fetchWeather')
            ->with($this->exactly($params));

//        $observer->fetchForWeatherWidget($params);
    }
}