<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Model\Dao;


class NewRelicDao extends AbstractDao {

    /**
     * Fetches CURRENT requests per minute for a given application - a single integer value
     * @param array $params - array with appId and other optional parameters for endpoint URL
     * @return int
     */
    public function fetchRpmForNumberWidget(array $params = array()) {
        $rpm = 0;

        $params['beginDateTime'] = date('Y-m-d', strtotime('-1 minute')) . 'T' . date('H:i:s', strtotime('-1 minute')) . 'Z';
        $params['endDateTime'] = date('Y-m-d') . 'T' . date('H:i:s') . 'Z';

        $response = $this->fetchRpmForGraphWidget($params);

        if (is_array($response) && isset($response[0])) {
            $rpm = $response[0]['requests_per_minute'];
        }

        return $rpm;
    }

    /**
     * Fetch array of requests per minute values from beginDateTime to endDateTime
     * with constant intervals.
     * @param array $params - array with appId and other optional parameters for endpoint URL
     * @return array
     */
    public function fetchRpmForGraphWidget(array $params = array()) {
        return $this->request($this->getEndpointUrl(__FUNCTION__), $params);
    }
}