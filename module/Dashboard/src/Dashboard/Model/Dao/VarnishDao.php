<?php
/**
 * All methods used for obtaining data through Varnish Web Interface
 *
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Model\Dao;

class VarnishDao extends AbstractDao
{
    /**
     * Fetch current RPM that reaches varnish on a given key
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     *
     * @return array
     */
    public function fetchRpmForIncrementalGraphWidget(array $params = [])
    {
        $responseParsed = [];
        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params);
        if (is_array($response[$params['key']])) {
            $singleStat = $response[$params['key']][0];
            $responseParsed = [
                'x' => strtotime($singleStat['timestamp']),
                'y' => round($singleStat['n_req']),
                'events' => [],
            ];
        }

        return $responseParsed;
    }

    public function fetchHitRateForIncrementalGraphWidget(array $params = [])
    {
        $responseParsed = [];
        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params);
        if (is_array($response[$params['key']])) {
            $singleStat = $response[$params['key']][0];
            $responseParsed = [
                'x' => strtotime($singleStat['timestamp']),
                'y' => $this->calculateHitRate($singleStat),
                'events' => [],
            ];
        }

        return $responseParsed;
    }

    public function fetchHitRateForUsageWidget(array $params = [])
    {
        return [
            'current_value' => $this->fetchHitRateForIncrementalGraphWidget($params)['y'],
            'maximum_value' => 100,
            'minimum_value' => 0,
        ];
    }

    private function calculateHitRate($singleStat) {
        return round(100 * (1 - $singleStat['n_miss']/$singleStat['n_req']), 2);
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
