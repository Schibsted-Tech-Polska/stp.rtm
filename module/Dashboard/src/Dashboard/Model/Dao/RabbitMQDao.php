<?php
namespace Dashboard\Model\Dao;

/**
 * Class RabbitMQDao
 *
 * @package Dashboard\Model\Dao
 */
class RabbitMQDao extends AbstractDao
{
    /**
     * Fetch jobs with workers attached
     *
     * @param  array $params Params
     * @return array
     */
    public function fetchQueuesForRabbitMQWidget(array $params = [])
    {
        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params);
        $queues = [];

        foreach ($response as $singleQueue) {
            $queues[$singleQueue['name']] = $singleQueue;
        }

        if (isset($params['ignoreQueues'])) {
            foreach ($queues as $key => $queue) {
                foreach ($params['ignoreQueues'] as $regex) {
                    if (preg_match('/' . $regex . '/s', $queue['name']) === 1) {
                        unset($queues[$key]);
                    }
                }
            }
        }

        if (isset($params['queueNameParser']) && is_callable($params['queueNameParser'])) {
            foreach ($queues as &$queue) {
                $queue['name'] = $params['queueNameParser']($queue['name']);
            }
        }

        return $queues;
    }

    /**
     * Fetch single queue stats with historical data
     * @param array $params
     * @return array
     */
    public function fetchQueuedMessagesForGraphWidget(array $params = [])
    {
        $responseParsed = [];
        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params);

        if (isset($response['messages_details']['samples'])) {
            foreach ($response['messages_details']['samples'] as $singleStat) {
                $responseParsed[] = [
                    'x' => $singleStat['timestamp'],
                    'y' => $singleStat['sample'],
                ];
            }

            $responseParsed = array_reverse($responseParsed);
        } else {
            //            $responseParsed = [
//                [
//                    'x' => 0,
//                    'y' => 0,
//                ],
//                [
//                    'x' => (int)gmdate('U') * 1000,
//                    'y' => 0,
//                ],
//            ];
        }

        return $responseParsed;
    }

    /**
     * @param array $params
     * @return mixed
     * @throws Exception\EndpointUrlNotDefined
     */
    public function fetchNodeMemoryUsageForUsageWidget(array $params = [])
    {
        $data = $this->request($this->getEndpointUrl(__FUNCTION__), $params);

        return [
            'current_value' => $data['mem_used'],
            'minimum_value' => 0,
            'maximum_value' => $data['mem_limit'],
        ];
    }

    /**
     * @param array $params
     * @return mixed
     * @throws Exception\EndpointUrlNotDefined
     */
    public function fetchNodeDiskUsageForUsageWidget(array $params = [])
    {
        $data = $this->request($this->getEndpointUrl(__FUNCTION__), $params);

        return [
            'current_value' => round(100 * $data['disk_free_limit'] / $data['disk_free'], 2),
            'minimum_value' => 0,
            'maximum_value' => 100,
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
}
