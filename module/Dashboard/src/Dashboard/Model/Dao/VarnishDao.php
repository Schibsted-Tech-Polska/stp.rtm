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
            $statsFromLastMinute = $this->groupResults(array_slice($response[$params['key']], 0, 6));
            $responseParsed = [
                'x' => strtotime($statsFromLastMinute['timestamp']),
                'y' => $statsFromLastMinute['n_req'],
                'events' => [],
            ];
        }

        return $responseParsed;
    }

    /**
     * Fetch cache hit ratio on a given key
     * @param array $params - array with appId and other optional parameters for endpoint URL
     * @return array
     */
    public function fetchHitRateForIncrementalGraphWidget(array $params = [])
    {
        $responseParsed = [];
        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params);
        if (is_array($response[$params['key']])) {
            $statsFromLastMinute = $this->groupResults(array_slice($response[$params['key']], 0, 6));
            $responseParsed = [
                'x' => strtotime($statsFromLastMinute['timestamp']),
                'y' => $this->calculateHitRate($statsFromLastMinute),
                'events' => [],
            ];
        }

        return $responseParsed;
    }

    /**
     * Fetch cache hit ratio on a given key
     * @param array $params - array with appId and other optional parameters for endpoint URL
     * @return array
     */
    public function fetchHitRateForUsageWidget(array $params = [])
    {
        return [
            'current_value' => $this->fetchHitRateForIncrementalGraphWidget($params)['y'],
            'maximum_value' => 100,
            'minimum_value' => 0,
        ];
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

    /**
     * Calculate hit rate as percentage of misses out of total results
     * @param array $stats
     * @return float
     */
    private function calculateHitRate(array $stats)
    {
        return round(100 * (1 - $stats['n_miss'] / $stats['n_req']), 2);
    }

    /**
     * Aggregate given stats timesamples into one
     * @param array $timesamples
     * @return array
     */
    private function groupResults(array $timesamples)
    {
        return array_reduce(
            $timesamples,
            function ($result, $timesample) {
                $result['timestamp'] = $timesample['timestamp'];
                $result['n_req'] += $timesample['n_req'];
                $result['n_miss'] += $timesample['n_miss'];
                $result['timesamples']++;

                return $result;
            },
            [
                'timestamp' => null,
                'n_req' => 0,
                'n_miss' => 0,
                'timesamples' => 0
            ]);
    }
}
