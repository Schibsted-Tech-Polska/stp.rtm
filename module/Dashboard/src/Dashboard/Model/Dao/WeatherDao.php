<?php

namespace Dashboard\Model\Dao;

class WeatherDao extends AbstractDao
{

    public function fetchForWeatherWidget(array $params)
    {
        return $this->request($this->getEndpointUrl(__FUNCTION__), $params);
    }
}
