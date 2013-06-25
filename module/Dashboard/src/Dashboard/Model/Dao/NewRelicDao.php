<?php
/**
 * All methods used for obtaining data through NewRelic REST API
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

        $params['beginDateTime'] = date('Y-m-d', strtotime('-5 minutes')) . 'T' . date('H:i:s', strtotime('-5 minutes')) . 'Z';
        $params['endDateTime'] = date('Y-m-d') . 'T' . date('H:i:s') . 'Z';

        $response = $this->fetchRpmForGraphWidget($params);

        if (is_array($response) && count($response)) {
            $result = array_pop($response);
            $rpm = $result['y'];
        }

        return $rpm;
    }

    /**
     * Fetches CURRENT requests per minute for a given application (FE) - a single integer value
     * @param array $params - array with appId and other optional parameters for endpoint URL
     * @return int
     */
    public function fetchFeRpmForNumberWidget(array $params = array()) {
        $rpm = 0;

        $params['beginDateTime'] = date('Y-m-d', strtotime('-5 minutes')) . 'T' . date('H:i:s', strtotime('-5 minutes')) . 'Z';
        $params['endDateTime'] = date('Y-m-d') . 'T' . date('H:i:s') . 'Z';

        $response = $this->fetchRpmForGraphWidget($params);

        if (is_array($response) && count($response)) {
            $result = array_pop($response);
            $rpm = $result['y'];
        }

        return $rpm;
    }

    public function fetchFeRpmForGraphWidget(array $params = array()) {
        $responseParsed = array();
        $response =  $this->request($this->getEndpointUrl(__FUNCTION__), $params);
        if (is_array($response)) {
            foreach ($response as $key => $singleStat) {
                $responseParsed[] = array('x' => 1000 * (strtotime($singleStat['begin']) + 7200), 'y' => $singleStat['requests_per_minute']);
            }
        }

        return $responseParsed;
    }

    /**
     * Fetch array of requests per minute values from beginDateTime to endDateTime
     * with constant intervals.
     * @param array $params - array with appId and other optional parameters for endpoint URL
     * @return array
     */
    public function fetchRpmForGraphWidget(array $params = array()) {
        $responseParsed = array();
        $response =  $this->request($this->getEndpointUrl(__FUNCTION__), $params);
        if (is_array($response)) {
            foreach ($response as $key => $singleStat) {
                $responseParsed[] = array('x' => 1000 * (strtotime($singleStat['begin']) + 7200), 'y' => $singleStat['requests_per_minute']);
            }
        }

        return $responseParsed;
    }

    /**
     * Number of errors per minute compared to total number of requests to the application
     * @param array $params - array with appId and other optional parameters for endpoint URL
     * @return mixed
     */
    public function fetchErrorRateForErrorWidget(array $params = array()) {
        $thresholdValues = $this->fetchThresholdValues($params);

        return $thresholdValues['Error Rate']['metric_value'];
    }

    /**
     * CPU shows the percentage of time spent in User space by the CPU as an average of reporting apps (agents).
     * @param array $params - array with appId and other optional parameters for endpoint URL
     * @return int
     */
    public function fetchCpuUsageForNumberWidget(array $params = array()) {
        $result = 0;

        $params['beginDateTime'] = date('Y-m-d', strtotime('-1 minute')) . 'T' . date('H:i:s', strtotime('-1 minute')) . 'Z';
        $params['endDateTime'] = date('Y-m-d') . 'T' . date('H:i:s') . 'Z';

        $response = $this->fetchCpuUsageForGraphWidget($params);

        if (is_array($response) && count($response)) {
            $result = array_pop($response);
            $result = $result['y'];
        }

        return $result;
    }

    /**
     * Fetch array of CPU usage values from beginDateTime to endDateTime
     * with constant intervals.
     * @param array $params - array with appId and other optional parameters for endpoint URL
     * @return array
     */
    public function fetchCpuUsageForGraphWidget(array $params = array()) {
        $responseParsed = array();
        $response =  $this->request($this->getEndpointUrl(__FUNCTION__), $params);
        if (is_array($response)) {
            foreach ($response as $key => $singleStat) {
                $responseParsed[] = array('x' => 1000 * (strtotime($singleStat['begin']) + 7200), 'y' => $singleStat['percent']);
            }
        }

        return $responseParsed;
    }

    /**
     * Returns average response time from the last minute in seconds
     * @param array $params - array with appId and other optional parameters for endpoint URL
     * @return float
     */
    public function fetchAverageResponseTimeForNumberWidget(array $params = array()) {
        $result = 0;

        $params['beginDateTime'] = date('Y-m-d', strtotime('-5 minutes')) . 'T' . date('H:i:s', strtotime('-5 minutes')) . 'Z';
        $params['endDateTime'] = date('Y-m-d') . 'T' . date('H:i:s') . 'Z';

        $response = $this->fetchAverageResponseTimeForGraphWidget($params);

        if (is_array($response) && count($response)) {
            $result = array_pop($response);
            $result = $result['y'];
        }

        return $result;
    }

    /**
     * Fetch array of average response time values from beginDateTime to endDateTime
     * with constant intervals.
     * @param array $params - array with appId and other optional parameters for endpoint URL
     * @return array
     */
    public function fetchAverageResponseTimeForGraphWidget(array $params = array()) {
        $responseParsed = array();
        $response =  $this->request($this->getEndpointUrl(__FUNCTION__), $params);
        if (is_array($response)) {
            foreach ($response as $key => $singleStat) {
                $responseParsed[] = array('x' => 1000 * (strtotime($singleStat['begin']) + 7200), 'y' => round($singleStat['average_response_time']*1000));
            }
        }

        return $responseParsed;
    }

    /**
     * Fetches memory usage by your app
     * @param array $params - array with appId and other optional parameters for endpoint URL
     * @return float
     */
    public function fetchMemoryForNumberWidget(array $params = array()) {
        $thresholdValues = $this->fetchThresholdValues($params);

        return $thresholdValues['Memory']['metric_value'];
    }

    /**
     * Fetches all threshold values for the application.
     * Because it can only be obtained in XML I manually parse it into an array.
     * @param array $params - array with appId and other optional parameters for endpoint URL
     * @return array
     */
    public function fetchThresholdValues(array $params = array()) {
        $result = array();

        $params['beginDateTime'] = date('Y-m-d', strtotime('-5 minutes')) . 'T' . date('H:i:s', strtotime('-5 minutes')) . 'Z';
        $params['endDateTime'] = date('Y-m-d') . 'T' . date('H:i:s') . 'Z';

        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params, self::RESPONSE_IN_XML);

        foreach ($response->threshold_value as $thresholdValue) {
            $thresholdValue = (array) $thresholdValue;
            $result[$thresholdValue['@attributes']['name']] = $thresholdValue['@attributes'];
        }

        return $result;
    }
}