<?php

namespace Dashboard\Model\Dao;


class HerokuStatusDao extends AbstractDao
{
    public function fetchForHerokuStatusWidget(array $params)
    {
        return $this->request($this->getEndpointUrl(__FUNCTION__), $params);
    }
}
