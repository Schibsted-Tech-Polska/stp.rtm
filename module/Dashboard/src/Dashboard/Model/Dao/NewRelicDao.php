<?php
/**
 * All methods used for obtaining data through NewRelic REST API
 *
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Model\Dao;

use Dashboard\Model\Dao\Exception\EndpointUrlNotAssembled;

class NewRelicDao extends AbstractDao
{
    /**
     * Adding datetimes parsing before assembling URL using parent method.
     * {@inheritdoc}
     */
    protected function assembleUrl($url, $params = array())
    {
        if (isset($params['beginDateTime'])) {
            $params['beginDateTime'] = gmdate('Y-m-d', strtotime($params['beginDateTime']))
                . 'T'
                . gmdate('H:i:s', strtotime($params['beginDateTime'])) . 'Z';
        }

        if (isset($params['endDateTime'])) {
            $params['endDateTime'] = gmdate('Y-m-d', strtotime($params['endDateTime']))
                . 'T'
                . gmdate('H:i:s', strtotime($params['endDateTime'])) . 'Z';
        }

        $url = parent::assembleUrl($url, $params);

        return $url;
    }

    /**
     * Fetches CURRENT requests per minute for a given application - a single integer value
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return int
     */
    public function fetchRpmForNumberWidget(array $params = array())
    {
        $rpm = 0;

        $params['beginDateTime'] = '-5 minutes';
        $params['endDateTime'] = 'now';

        $response = $this->fetchRpmForGraphWidget($params);

        if (is_array($response) && count($response)) {
            $result = array_pop($response);
            $rpm = $result['y'];
        }

        return $rpm;
    }

    /**
     * Fetches CURRENT requests per minute for a given application (FE) - a single integer value
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return int
     */
    public function fetchFeRpmForNumberWidget(array $params = array())
    {
        $rpm = 0;

        $params['beginDateTime'] = '-5 minutes';
        $params['endDateTime'] = 'now';

        $response = $this->fetchFeRpmForGraphWidget($params);

        if (is_array($response) && count($response)) {
            $result = array_pop($response);
            $rpm = $result['y'];
        }

        return $rpm;
    }

    public function fetchFeRpmForGraphWidget(array $params = array())
    {
        $responseParsed = array();
        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params);
        if (is_array($response)) {
            foreach ($response as $singleStat) {
                $responseParsed[] = array(
                    'x' => 1000 * (strtotime($singleStat['begin']) + 7200),
                    'y' => round($singleStat['requests_per_minute'])
                );
            }
        }

        return $responseParsed;
    }

    /**
     * Fetch array of requests per minute values from beginDateTime to endDateTime
     * with constant intervals.
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return array
     */
    public function fetchRpmForGraphWidget(array $params = array())
    {
        $responseParsed = array();
        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params);
        if (is_array($response)) {
            foreach ($response as $singleStat) {
                $responseParsed[] = array(
                    'x' => 1000 * (strtotime($singleStat['begin']) + 7200),
                    'y' => round($singleStat['requests_per_minute'])
                );
            }
        }

        return $responseParsed;
    }

    /**
     * Number of errors per minute compared to total number of requests to the application
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return mixed
     */
    public function fetchErrorRateForErrorWidget(array $params = array())
    {
        $thresholdValues = $this->fetchThresholdValues($params);

        return $thresholdValues['Error Rate']['metric_value'];
    }

    /**
     * Error rate for incremental graph widget
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return mixed
     */
    public function fetchErrorRateForIncrementalGraphWidget(array $params = array())
    {
        $thresholdValues = $this->fetchThresholdValues($params);

        return array(
            'x' => (int) $this->convertTimeBetweenTimezones(
                $thresholdValues['Error Rate']['end_time'],
                'UTC',
                date_default_timezone_get(),
                'U'
            ),
            'y' => $thresholdValues['Error Rate']['metric_value'],
            'events' => $this->fetchDeploymentEvents($params),
        );
    }

    /**
     * Apdex value
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return mixed
     */
    public function fetchApdexForNumberWidget(array $params = array())
    {
        $thresholdValues = $this->fetchThresholdValues($params);

        return $thresholdValues['Apdex']['metric_value'];
    }

    /**
     * Apdex value
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return mixed
     */
    public function fetchApdexForIncrementalGraphWidget(array $params = array())
    {
        $thresholdValues = $this->fetchThresholdValues($params);

        return array(
            'x' => (int) $this->convertTimeBetweenTimezones(
                $thresholdValues['Apdex']['end_time'],
                'UTC',
                date_default_timezone_get(),
                'U'
            ),
            'y' => $thresholdValues['Apdex']['metric_value'],
            'events' => $this->fetchDeploymentEvents($params),
        );
    }

    /**
     * CPU shows the percentage of time spent in User space by the CPU as an average of reporting apps (agents).
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return int
     */
    public function fetchCpuUsageForNumberWidget(array $params = array())
    {
        $result = 0;

        $params['beginDateTime'] = '-1 minute';
        $params['endDateTime'] = 'now';

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
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return array
     */
    public function fetchCpuUsageForGraphWidget(array $params = array())
    {
        $responseParsed = array();
        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params);
        if (is_array($response)) {
            foreach ($response as $singleStat) {
                $responseParsed[] = array(
                    'x' => 1000 * (strtotime($singleStat['begin']) + 7200),
                    'y' => $singleStat['percent']
                );
            }
        }

        return $responseParsed;
    }

    /**
     * Returns average response time from the last minute in seconds
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return float
     */
    public function fetchAverageResponseTimeForNumberWidget(array $params = array())
    {
        $result = 0;

        $params['beginDateTime'] = '-5 minutes';
        $params['endDateTime'] = 'now';

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
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return array
     */
    public function fetchAverageResponseTimeForGraphWidget(array $params = array())
    {
        $responseParsed = array();
        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params);
        if (is_array($response)) {
            foreach ($response as $singleStat) {
                $responseParsed[] = array(
                    'x' => 1000 * (strtotime($singleStat['begin']) + 7200),
                    'y' => round($singleStat['average_response_time'] * 1000)
                );
            }
        }

        return $responseParsed;
    }

    /**
     * Fetches memory usage by your app
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return float
     */
    public function fetchMemoryForNumberWidget(array $params = array())
    {
        $thresholdValues = $this->fetchThresholdValues($params);

        return $thresholdValues['Memory']['metric_value'];
    }

    /**
     * Fetches memory usage by your app
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return float
     */
    public function fetchMemoryForIncrementalGraphWidget(array $params = array())
    {
        $thresholdValues = $this->fetchThresholdValues($params);

        return array(
            'x' => (int) $this->convertTimeBetweenTimezones(
                $thresholdValues['Memory']['end_time'],
                'UTC',
                date_default_timezone_get(),
                'U'
            ),
            'y' => $thresholdValues['Memory']['metric_value'],
            'events' => $this->fetchDeploymentEvents($params),
        );
    }

    /**
     * Fetches CPU usage by your app based on thresholds.xml (good for free accounts).
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return float
     */
    public function fetchCpuFromThresholdForNumberWidget(array $params = array())
    {
        $thresholdValues = $this->fetchThresholdValues($params);

        return $thresholdValues['CPU']['metric_value'];
    }

    /**
     * Fetches CPU usage by your app based on thresholds.xml (good for free accounts).
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return float
     */
    public function fetchCpuFromThresholdForIncrementalGraphWidget(array $params = array())
    {
        $thresholdValues = $this->fetchThresholdValues($params);

        return array(
            'x' => (int) $this->convertTimeBetweenTimezones(
                $thresholdValues['CPU']['end_time'],
                'UTC',
                date_default_timezone_get(),
                'U'
            ),
            'y' => $thresholdValues['CPU']['metric_value'],
            'events' => $this->fetchDeploymentEvents($params),
        );
    }

    /**
     * Fetches DB usage by your app based on thresholds.xml (good for free accounts).
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return float
     */
    public function fetchDBFromThresholdForNumberWidget(array $params = array())
    {
        $thresholdValues = $this->fetchThresholdValues($params);

        return $thresholdValues['DB']['metric_value'];
    }

    /**
     * Fetches DB usage by your app based on thresholds.xml (good for free accounts).
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return float
     */
    public function fetchDBFromThresholdForIncrementalGraphWidget(array $params = array())
    {
        $thresholdValues = $this->fetchThresholdValues($params);

        return array(
            'x' => (int) $this->convertTimeBetweenTimezones(
                $thresholdValues['DB']['end_time'],
                'UTC',
                date_default_timezone_get(),
                'U'
            ),
            'y' => $thresholdValues['DB']['metric_value'],
            'events' => $this->fetchDeploymentEvents($params),
        );
    }

    /**
     * Fetches throughput by your app based on thresholds.xml (good for free accounts).
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return float
     */
    public function fetchThroughputFromThresholdForNumberWidget(array $params = array())
    {
        $thresholdValues = $this->fetchThresholdValues($params);

        return $thresholdValues['Throughput']['metric_value'];
    }

    /**
     * Fetches throughput by your app based on thresholds.xml (good for free accounts).
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return float
     */
    public function fetchThroughputFromThresholdForIncrementalGraphWidget(array $params = array())
    {
        $thresholdValues = $this->fetchThresholdValues($params);

        return array(
            'x' => (int) $this->convertTimeBetweenTimezones(
                $thresholdValues['Throughput']['end_time'],
                'UTC',
                date_default_timezone_get(),
                'U'
            ),
            'y' => $thresholdValues['Throughput']['metric_value'],
            'events' => $this->fetchDeploymentEvents($params),
        );
    }

    /**
     * Fetches response time by your app based on thresholds.xml (good for free accounts).
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return float
     */
    public function fetchResponseTimeFromThresholdForNumberWidget(array $params = array())
    {
        $thresholdValues = $this->fetchThresholdValues($params);

        return $thresholdValues['Response Time']['metric_value'];
    }

    /**
     * Fetches response time by your app based on thresholds.xml (good for free accounts).
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return float
     */
    public function fetchResponseTimeFromThresholdForIncrementalGraphWidget(array $params = array())
    {
        $thresholdValues = $this->fetchThresholdValues($params);

        return array(
            'x' => (int) $this->convertTimeBetweenTimezones(
                $thresholdValues['Response Time']['end_time'],
                'UTC',
                date_default_timezone_get(),
                'U'
            ),
            'y' => $thresholdValues['Response Time']['metric_value'],
            'events' => $this->fetchDeploymentEvents($params),
        );
    }

    /**
     * Fetches all threshold values for the application.
     * Because it can only be obtained in XML I manually parse it into an array.
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return array
     */
    public function fetchThresholdValues(array $params = array())
    {
        $result = array();

        $params['beginDateTime'] = '-5 minutes';
        $params['endDateTime'] = 'now';

        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params, self::RESPONSE_IN_XML);

        foreach ($response->threshold_value as $thresholdValue) {
            $thresholdValue = (array)$thresholdValue;
            $result[$thresholdValue['@attributes']['name']] = $thresholdValue['@attributes'];
        }

        return $result;
    }

    /**
     * Fetches events for the application.
     * Because it can only be obtained in XML I manually parse it into an array.
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return array
     */
    public function fetchEvents(array $params = array())
    {
        $result = array();

        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params, self::RESPONSE_IN_XML);

        foreach ($response->channel->item as $event) {
            $event = (array)$event;
            if (preg_match('/\[([a-z]+)\](.*)/i', $event['title'], $matches)) {
                if (!empty($params['eventType']) && $params['eventType'] == $matches[1]) {
                    $result[] = array(
                        'title' => trim($matches[2], ' -.'),
                        'date' => strtotime($event['pubDate']), // doesn't need TimeZone conversion
                        'type' => $matches[1],
                    );
                }
            } else {
                $result[] = array(
                    'title' => $event['title'],
                    'date' => strtotime($event['pubDate']), // doesn't need TimeZone conversion
                    'type' => '',
                );
            }
        }

        return $result;
    }

    /**
     * Fetches deployment events for the application.
     *
     * @param  array $params - array with appId and other optional parameters for endpoint URL
     * @return array
     */
    public function fetchDeploymentEvents(array $params = array())
    {
        $events = array();
        if (!empty($this->getDaoParams()['feed']) || !empty($params['feed'])) {
            $events = $this->fetchEvents($params + array('eventType' => 'deployment'));
        }

        return $events;
    }

    /**
     * Fetches threshold values set for this metric (if they are set)
     * @param  array $params widget params
     * @return array
     */
    public function fetchThreshold(array $params = array())
    {
        $result = array();
        try {
            $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params, self::RESPONSE_IN_XML);
            foreach ($response->threshold as $thresholdValue) {
                if (strtolower($params['metric']) == strtolower((string)$thresholdValue->type)) {
                    $result = (array)$thresholdValue;
                    break;
                }
            }
            if (empty($result)) {
                throw new EndpointUrlNotAssembled('Could not find requested metric thresholds');
            }
        } catch (EndpointUrlNotAssembled $e) {
            $result = array(
                'caution-value' => isset($params['caution-value']) ? $params['caution-value'] : 0,
                'critical-value' => isset($params['critical-value']) ? $params['critical-value'] : 0,
            );
        }

        return $result;
    }

    /**
     * Helper function to convert time between timezones.
     * @param $time
     * @param $originTimezone
     * @param $targetTimezone
     * @param  string $format
     * @return string
     */
    private function convertTimeBetweenTimezones($time, $originTimezone, $targetTimezone, $format = 'Y-m-d H:i:s')
    {
        try {
            $convertedTime = new \DateTime($time, new \DateTimeZone($originTimezone));
        } catch (\Exception $e) {
            $date = \DateTime::createFromFormat('m DD,yy hh:MM meridian', $time);
            $convertedTime = new \DateTime($date, new \DateTimeZone($originTimezone));
        }
        $convertedTime->setTimeZone(new \DateTimeZone($targetTimezone));

        return $convertedTime->format($format);
    }

    /**
     * @param array $params
     * @return mixed
     * @throws Exception\EndpointUrlNotDefined
     */
    public function fetchDiskUsageForUsageWidget(array $params = array())
    {
        $data = $this->request($this->getEndpointUrl(__FUNCTION__), $params);
        $currentValue = $data['metric_data']['metrics'][0]['timeslices'][0]['values']['average_response_time'];
        $maximumValue = $data['metric_data']['metrics'][0]['timeslices'][0]['values']['average_exclusive_time'];

        return [
            'current_value' => $currentValue,
            'maximum_value' => $maximumValue,
            'minimum_value' => 0,
        ];
    }

    /**
     * @param array $params
     * @return array
     * @throws Exception\EndpointUrlNotDefined
     */
    public function fetchMemoryUsageForUsageWidget(array $params = array())
    {
        $data = $this->request($this->getEndpointUrl(__FUNCTION__), $params);

        $currentValue = $data['metric_data']['metrics'][0]['timeslices'][0]['values']['average_response_time'] / 1024;
        $maximumValue = $data['metric_data']['metrics'][0]['timeslices'][0]['values']['average_exclusive_time'] / 1024;

        return [
            'current_value' => $currentValue,
            'maximum_value' => $maximumValue,
            'minimum_value' => 0,
        ];
    }

    public function fetchServerCpuUsageForGraphWidget(array $params = array())
    {
        $responseParsed = array();
        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params);

        if (is_array($response['metric_data']['metrics'][0]['timeslices'])) {
            foreach ($response['metric_data']['metrics'][0]['timeslices'] as $key => $singleStat) {
                $responseParsed[] = array(
                    'x' => 1000 * (strtotime($singleStat['to']) + 7200),
                    'y' => $singleStat['values']['average_value'] + $response['metric_data']['metrics'][1]['timeslices'][$key]['values']['average_value']
                );
            }
        }

        return $responseParsed;
    }
}
