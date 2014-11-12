<?php
return [
    'RabbitMQDao' => [
        'urls' => [
            'fetchQueuesForRabbitMQWidget' => ':rabbitMQUrl:/api/queues/:vhost:',
            'fetchQueuedMessagesForGraphWidget' => ':rabbitMQUrl:/api/queues/:vhost:/:queueName:?lengths_age=:secondsBack:&lengths_incr=:secondsIntervals:',
            'fetchNodeMemoryUsageForRabbitMemoryWidget' => ':rabbitMQUrl:/api/nodes/:nodeName:?memory=true'
        ],
    ],
];
