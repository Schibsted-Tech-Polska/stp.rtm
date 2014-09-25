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
        $queues = $this->request($this->getEndpointUrl(__FUNCTION__), $params);

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
}
