<?php
return [
    'RabbitMQDao' => [
        'urls' => [
            'fetchQueuesForRabbitMQWidget' => ':rabbitMQUrl:/api/queues/:vhost:',
            'fetchQueuedMessagesForGraphWidget' =>
                ':rabbitMQUrl:/api/queues/:vhost:/:queueName:?lengths_age=:secondsBack:'
                . '&lengths_incr=:secondsIntervals:',
            'fetchNodeMemoryUsageForUsageWidget' => ':rabbitMQUrl:/api/nodes/:nodeName:',
            'fetchNodeDiskUsageForUsageWidget' => ':rabbitMQUrl:/api/nodes/:nodeName:',
        ],
    ],
];
