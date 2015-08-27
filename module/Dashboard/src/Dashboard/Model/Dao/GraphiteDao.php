<?php
/**
 * All methods used for obtaining data from Graphite
 */

namespace Dashboard\Model\Dao;

class GraphiteDao extends AbstractDao
{
    /**
     * Fetches CURRENT requests per minute for a given application - a single integer value
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return int
     */
    public function fetchDataForNumberWidget(array $params = [])
    {
        $rpm = 0;

        $params['from'] = '-5 minutes';
        $params['until'] = '-0hour';

        $response = $this->fetchDataForGraphWidget($params);

        if (is_array($response) && count($response)) {
            $result = array_pop($response);
            $rpm = $result['y'];
        }

        return $rpm;
    }

    /**
     * Fetch array of requests per minute values from beginDateTime to endDateTime
     * with constant intervals.
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return array
     */
    public function fetchDataForGraphWidget(array $params = [])
    {
        $responseParsed = [];
        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params, self::RESPONSE_IN_JSON, true);
        if (is_array($response)) {
            $response = reset($response);
            $timestamp = $response['start'];
            foreach ($response['data'] as $singleStat) {
                $responseParsed[] = [
                    'x' => 1000 * ($timestamp + 7200),
                    'y' => round($singleStat, 2),
                ];
                $timestamp += ($response['step']);
            }
        }

        return $responseParsed;
    }

    /**
     * @param $params
     * @return array
     */
    public function fetchThreshold($params)
    {
        $threshold = [
            'caution-value' => isset($params['caution-value']) ? $params['caution-value'] : 0,
            'critical-value' => isset($params['critical-value']) ? $params['critical-value'] : 0,
        ];

        return $threshold;
    }
}
