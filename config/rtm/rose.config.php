<?php
/**
 * Config for rtm
 */
return array(
    'theme' => ['tv', 'dark'],
    'splunk' => array(
        'params' => array(
            'baseUrl' => 'https://mother.int.vgnett.no:8089',
        ),
        'auth' => array(
            'username' => 'wiskra',
            'password' => 'DopdeDey',
        ),
    ),
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
    'hipChat' => array(
        'params' => array(
            'auth_token' => 'd5e182ac9d356cbc72b9f9c2fc119f',
        ),
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
        array('id' => 'messagesRose',
            'type' => 'messages',
            'params' => array(
                'dao' => 'hipChat',
                'metric' => 'listRecentMessages',
                'span' => 6,
                'subtitle' => '',
                'title' => 'Rose',
                'limit' => 10,
                'room' => '678527',
                'refreshRate' => 30,
                'fromUser' => ['jenkins', 'Cap4All'],
            ),
        ),
        array('id' => 'roseBuildStatuCore',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Rose_v2',
                'job' => 'Rose_v2_core',
                'metric' => 'status',
                'title' => 'Core',
                'refreshRate' => 5,
                'span' => '1',
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
                'span' => '1',
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
                'span' => '1',
            ),
        ),
        array('id' => 'roseBuildStatusJS',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Rose_v2',
                'job' => 'Rose_v2_develop-mocha',
                'metric' => 'status',
                'title' => 'JavaScript',
                'refreshRate' => 5,
                'span' => '1',
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
                    'output_mode' => 'json_cols',
                ],
                'span' => 4,
            ),
        ),
         array('id' => 'roseE24Splunk500',
            'type' => 'alert',
            'params' => array(
                'dao' => 'splunk',
                'metric' => 'Fivehundreds',
                'title' => 'Rose (production E24)',
                'subtitle' => '500 errors in last 24h',
                'config' => [
                    'search' => 'search sourcetype=apache_access source="/var/log/httpd/rose-app-e24-access.log" host=vg-rose-01* status=500 | stats count latest(_time) as latestTime by url | sort -count | head 5',
                    'earliest_time' => '-24h',
                    'latest' => 'now',
                    'output_mode' => 'json_cols',
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
                    'output_mode' => 'json_cols',
                ],
                'span' => 4,
            ),
        ),
        array(
            'id' => 'prodRabbitMQQueues',
            'type' => 'rabbitMQ',
            'params' => array(
                'dao' => 'rabbitMQ',
                'metric' => 'queues',
                'title' => 'RabbitMQ',
                'span' => 4,
                'ignoreQueues' => ['.*testing.*', '.*:invalid:.*', '.*:not-existing:.*', 'aliveness-test'],
                'queueNameParser' => function($queueName) { return str_replace(':management', '', $queueName);},
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
                'span' => 4,
                'ignoreQueues' => ['.*testing.*', '.*:invalid:.*', '.*:not-existing:.*', 'aliveness-test'],
                'queueNameParser' => function($queueName) { return str_replace(':management', '', $queueName);},
            ),
        ),
        array(
            'id' => 'devIntegratorRabbitMQQueues',
            'type' => 'rabbitMQ',
            'params' => array(
                'rabbitMQUrl' => 'http://vg-dev-01:15672',
                'dao' => 'rabbitMQ',
                'metric' => 'queues',
                'title' => 'RabbitMQ (dev)',
                'span' => 4,
                'ignoreQueues' => ['.*testing.*', '.*:invalid:.*', '.*:not-existing:.*', 'aliveness-test'],
                'queueNameParser' => function($queueName) { return str_replace(':management', '', $queueName);},
            ),
        ),
        // QUEUES
//        array('id' => 'roseTestMessages',
//            'type' => 'graph',
//            'params' => array(
//                'dao' => 'rabbitMQ',
//                'metric' => 'queuedMessages',
//                'title' => 'Test',
//                'subtitle' => 'test',
//                'span' => 1,
//                'queueName' => 'rose:test:test:queue',
//                'secondsBack' => '1200',
//                'secondsIntervals' => '5',
//                'refreshRate' => 5,
//                'thresholdComparator' => 'lowerIsBetter',
//                'caution-value' => 1000000,
//                'critical-value' => 5000000,
//            ),
//        ),
     ),
);
