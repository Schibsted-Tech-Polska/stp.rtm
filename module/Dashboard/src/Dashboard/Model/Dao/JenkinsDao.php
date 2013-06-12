<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Model\Dao;


class JenkinsDao extends AbstractDao {
    public function fetchStatus($params) {
        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params);

        //@TODO Wojtek: parse whole response and return only necessary data

        return $response;
    }
}