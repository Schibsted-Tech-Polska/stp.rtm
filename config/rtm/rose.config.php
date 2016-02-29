<?php
/**
 * Config for rtm
 */
return array(
    'theme' => ['tv', 'dark'],
    'splunk' => [
        'params' => [
            'baseUrl' => 'https://splunk-01.int.vgnett.no:8089',
        ],
        'auth' => [
            'username' => 'stprtm',
            'password' => 'VTNAj7s8WErvR9uYhZeA',
        ],
    ],
    'jenkins' => array(
        'params' => array(
            'baseUrl' => 'http://ci.vgnett.no/',
        ),
    ),
    'newRelic' => array(
        'headers' => array(
            'x-api-key' => '0116c7512e1efa28a39116312e9640edb90f1f52bb6ab30'
        ),
        'params' => array(
            'accountId' => '100366'
        )
    ),
    'rabbitMQ' => array(
        'params' => array(
            'rabbitMQUrl' => 'http://vg-rabbit-01:15672',
            'vhost' => 'rose',
        ),
        'headers' => array(
            'X-Requested-With' => 'XMLHttpRequest',
        ),
        'auth' => array(
            'username' => 'rose',
            'password' => 'MxPEMso4Dni9bD',
        ),
    ),
    'widgets' => array(
        array('id' => 'roseBuildStatuCore',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Rose_v2',
                'job' => 'Rose_v2_core',
                'metric' => 'status',
                'title' => 'Core',
                'refreshRate' => 5,
                'span' => '2',
            ),
        ),
        array('id' => 'roseBuildStatusDevelop',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Rose_v2',
                'job' => 'Rose_v2_develop',
                'metric' => 'status',
                'title' => 'Unit & Spec tests',
                'refreshRate' => 5,
                'span' => '2',
            ),
        ),
        array('id' => 'roseBuildStatusIntegration',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Rose_v2',
                'job' => 'rose2-api-integration',
                'metric' => 'status',
                'title' => 'Integration',
                'refreshRate' => 5,
                'span' => '2',
            ),
        ),
        array('id' => 'roseBuildStatusQuality',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Rose_v2',
                'job' => 'Rose_v2_develop-quality',
                'metric' => 'status',
                'title' => 'Code quality',
                'refreshRate' => 5,
                'span' => '2',
            ),
        ),
        array('id' => 'roseBuildStatusJS',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Rose_v2',
                'job' => 'Rose_v2_develop - Karma',
                'metric' => 'status',
                'title' => 'JavaScript',
                'refreshRate' => 5,
                'span' => '4',
            ),
        ),
        array(
            'id' => 'prodRabbitMQQueues',
            'type' => 'rabbitMQ',
            'params' => array(
                'dao' => 'rabbitMQ',
                'metric' => 'queues',
                'title' => 'RabbitMQ',
                'span' => 2,
                'ignoreQueues' => ['.*testing.*', '.*:invalid:.*', '.*:not-existing:.*', 'aliveness-test', 'email:send', 'querystring:*', 'entity:*', 'rose:*', 'availability', 'ims:*'],
                'queueNameParser' => function($queueName) { return str_replace([':management', 'rose:'], '', $queueName);},
            ),
        ),
        array(
            'id' => 'prodRabbitMQQueuesAdditional',
            'type' => 'rabbitMQ',
            'params' => array(
                'dao' => 'rabbitMQ',
                'metric' => 'queues',
                'title' => 'RabbitMQ',
                'span' => 2,
                'ignoreQueues' => ['.*testing.*', '.*:invalid:.*', '.*:not-existing:.*', 'aliveness-test', 'email:send', 'changelog:*', 'campaign:*', 'customer:*', 'sync:*', 'booking:inventory'],
                'queueNameParser' => function($queueName) { return str_replace([':management', 'rose:'], '', $queueName);},
            ),
        ),
        array('id' => 'roseProdEmails',
            'type' => 'graph',
            'params' => array(
                'dao' => 'rabbitMQ',
                'metric' => 'queuedMessages',
                'title' => 'Emails',
                'subtitle' => 'production',
                'span' => 2,
                'queueName' => 'email:send',
                'secondsBack' => '1200',
                'secondsIntervals' => '5',
                'refreshRate' => 5,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 10,
                'critical-value' => 50,
            ),
        ),
        array(
            'id' => 'stagingRabbitMQQueues',
            'type' => 'rabbitMQ',
            'params' => array(
                'rabbitMQUrl' => 'http://vg-rabbit-s01:15672',
                'dao' => 'rabbitMQ',
                'metric' => 'queues',
                'title' => 'RabbitMQ',
                'span' => 2,
                'ignoreQueues' => ['.*testing.*', '.*:invalid:.*', '.*:not-existing:.*', 'aliveness-test', 'email:send', 'querystring:*', 'entity:*', 'rose:*', 'availability', 'ims:*'],
                'queueNameParser' => function($queueName) { return str_replace([':management', 'rose:'], '', $queueName);},
            ),
        ),
        array(
            'id' => 'stagingRabbitMQQueuesAdditional',
            'type' => 'rabbitMQ',
            'params' => array(
                'rabbitMQUrl' => 'http://vg-rabbit-s01:15672',
                'dao' => 'rabbitMQ',
                'metric' => 'queues',
                'title' => 'RabbitMQ',
                'span' => 2,
                'ignoreQueues' => ['.*testing.*', '.*:invalid:.*', '.*:not-existing:.*', 'aliveness-test', 'email:send', 'changelog:*', 'campaign:*', 'customer:*', 'sync:*', 'booking:inventory'],
                'queueNameParser' => function($queueName) { return str_replace([':management', 'rose:'], '', $queueName);},
            ),
        ),
        array('id' => 'roseStagingEmails',
            'type' => 'graph',
            'params' => array(
                'rabbitMQUrl' => 'http://vg-rabbit-s01:15672',
                'dao' => 'rabbitMQ',
                'metric' => 'queuedMessages',
                'title' => 'Emails',
                'subtitle' => 'staging',
                'span' => 2,
                'queueName' => 'email:send',
                'secondsBack' => '1200',
                'secondsIntervals' => '5',
                'refreshRate' => 5,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 10,
                'critical-value' => 50,
            ),
        ),
        array(
            'id' => 'roseAverageResponseTime',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'averageResponseTime',
                'appId' => '4678474',
                'title' => 'Avg response time (vg-rose-01)',
                'span' => 3,
                'valueSuffix' => 'ms',
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now'
            )
        ),
        array(
            'id' => 'roseCpuUsage',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'cpuUsage',
                'appId' => '4678474',
                'title' => 'CPU usage (vg-rose-01)',
                'span' => 3,
                'valueSuffix' => '%',
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now'
            )
        ),
        array(
            'id' => 'roseMemoryUsage',
            'type' => 'number',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'memory',
                'appId' => '4678474',
                'title' => 'Memory usage (vg-rose-01)',
                'span' => 3,
                'valueSuffix' => 'MB',
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now'
            )
        ),
        array(
            'id' => 'roseBeRpm',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'rpm',
                'appId' => '4678474',
                'title' => 'Backend RPM (vg-rose-01)',
                'span' => 3,
                'valueSuffix' => 'hits',
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now'
            )
        ),
        array('id' => 'roseSplunk500',
            'type' => 'alert',
            'params' => array(
                'dao' => 'splunk',
                'metric' => 'Fivehundreds',
                'title' => 'Rose (production)',
                'subtitle' => '500 errors in last 24h',
                'config' => [
                    'search' => 'search sourcetype=apache_access source="/var/log/httpd/rose-app-access.log" host=vg-rose-01* status=500 | stats count latest(_time) as latestTime by url | sort -count | head 5',
                    'earliest_time' => '-24h',
                    'latest' => 'now',
                    'output_mode' => 'json',
                    'exec_mode' => 'oneshot',
                ],
                'span' => 4,
            ),
        ),
        array('id' => 'roseSplunkTopUrls',
            'type' => 'table',
            'params' => array(
                'dao' => 'splunk',
                'metric' => 'TopUrls',
                'title' => 'Rose (production)',
                'subtitle' => 'most popular URLs in last 24h',
                'config' => [
                    'search' => 'search host="vg-rose-01*" sourcetype=apache_access url != "rose-app.e24.no*" url != "localhost/server-status" url != "10.84.200.208/index.html" | top limit=100 url | stats sum(count) AS NumOf by url | sort -num(NumOf) | head 8',
                    'earliest_time' => '-24h',
                    'latest' => 'now',
                    'output_mode' => 'json_cols',
                    'preview' => 0,
                ],
                'span' => 4,
            ),
        ),
        array('id' => 'roseStageSplunk500',
            'type' => 'alert',
            'params' => array(
                'dao' => 'splunk',
                'metric' => 'Fivehundreds',
                'title' => 'Rose (stage)',
                'subtitle' => '500 errors in last 24h',
                'config' => [
                    'search' => 'search sourcetype=apache_access host=vg-rose-s01* status=500 | stats count latest(_time) as latestTime by url | sort -count | head 5',
                    'earliest_time' => '-24h',
                    'latest' => 'now',
                    'output_mode' => 'json',
                    'exec_mode' => 'oneshot',
                ],
                'span' => 4,
            ),
        ),
     ),
);
