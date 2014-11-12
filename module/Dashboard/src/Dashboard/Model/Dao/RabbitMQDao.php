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
    public function fetchQueuesForRabbitMQWidget(array $params = array())
    {
        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params);
        $queues = array();

        foreach ($response as $singleQueue) {
            $queues[$singleQueue['name']] = $singleQueue;
        }

        foreach ($queues as $queueName => $queueInfo) {
            $invalidQueueName = str_replace(':queue', ':invalid:queue', $queueInfo['name']);
            if (isset($queues[$invalidQueueName])) {
                $queues[$queueName]['invalidQueueInfo'] = $queues[$invalidQueueName];
            }
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
    public function fetchQueuedMessagesForGraphWidget(array $params = array())
    {
        $responseParsed = array();
        $response = $this->request($this->getEndpointUrl(__FUNCTION__), $params);

        if (isset($response['messages_details']['samples'])) {
            foreach ($response['messages_details']['samples'] as $singleStat) {
                $responseParsed[] = [
                    'x' => $singleStat['timestamp'],
                    'y' => $singleStat['sample']
                ];
            }

            $responseParsed = array_reverse($responseParsed);
        } else {
            $responseParsed = [
                [
                    'x' => 0,
                    'y' => 0,
                ],
                [
                    'x' => (int)gmdate('U') * 1000,
                    'y' => 0,
                ],
            ];
        }

        return $responseParsed;
    }

    /**
     * @param array $params
     * @return mixed
     * @throws Exception\EndpointUrlNotDefined
     */
    public function fetchNodeMemoryUsageForRabbitMemoryWidget(array $params = array())
    {
        return $this->request($this->getEndpointUrl(__FUNCTION__), $params);
    }

    /**
     * @param $params
     * @return array
     */
    public function fetchThreshold($params)
    {
        $threshold = array(
            'caution-value' => isset($params['caution-value']) ? $params['caution-value'] : 0,
            'critical-value' => isset($params['critical-value']) ? $params['critical-value'] : 0,
        );

        return $threshold;
    }
}
