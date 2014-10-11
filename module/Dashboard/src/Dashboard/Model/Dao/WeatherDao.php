<?php

namespace Dashboard\Model\Dao;

class WeatherDao extends AbstractDao
{

    public function fetchForWeatherWidget(array $params)
    {
        return $this->fetchWeather($params);
    }

    private function fetchWeather($params)
    {
        return $this->request($this->getEndpointUrl(__FUNCTION__), $params);
    }
} 