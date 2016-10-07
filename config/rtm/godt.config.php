<?php
/**
 * Config for rtm
 */
return array(
    'theme' => ['tv', 'dark'],
    'newRelic' => array(
        'headers' => array(
            'x-api-key' => '0116c7512e1efa28a39116312e9640edb90f1f52bb6ab30',
        ),
        'params' => array(
            'accountId' => '100366',
        ),
    ),
    'rabbitMQ' => array(
        'params' => array(
            'rabbitMQUrl' => 'http://vg-rabbit-01:15672',
            'vhost' => 'godt',
        ),
        'headers' => array(
            'X-Requested-With' => 'XMLHttpRequest',
        ),
        'auth' => array(
            'username' => 'godt-admin',
            'password' => 'iKae3coh',
        ),
    ),
    'slack' => array(
        'params' => array(
            'token' => 'xoxp-3176818426-4103564791-4117485223-5606c6',
        ),
    ),
    'splunk' => array(
        'params' => array(
            'baseUrl' => 'https://splunk-01.int.vgnett.no:8089',
        ),
        'auth' => array(
            'username' => 'stprtm',
            'password' => 'VTNAj7s8WErvR9uYhZeA',
        ),
    ),
    'jenkins' => array(
        'params' => array(
            'baseUrl' => 'http://ci.vgnett.no/',
        ),
    ),
    'graphite' => array(
        'params' => array(
            'graphiteUrl' => 'graphite.vgnett.no',
        ),
    ),
    'supervisord' => [
        'params' => [
            'baseUrl' => 'http://godt-web-01:9001/RPC2',
        ],
    ],
    'widgets' => array(
        array('id' => 'vgFoodSplunk500',
            'type' => 'alert',
            'params' => array(
                'dao' => 'splunk',
                'metric' => 'Fivehundreds',
                'title' => 'Godt.no',
                'subtitle' => '500 errors in last 24h',
                'config' => [
                    'search' => 'search sourcetype=apache_access NOT(toolbox) (host=godt-web-* OR url=red.vgnett.no/godt-admin/*) status=500 | stats count latest(_time) as latestTime by url | sort -count | head 5',
                    'earliest_time' => '-1h',
                    'latest' => 'now',
                    'output_mode' => 'json',
                    'exec_mode' => 'oneshot',
                ],
                'span' => 3,
            ),
        ),
        array('id' => 'godtImboUploaderProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'Imbo',
                'subtitle' => 'uploader',
                'processName' => 'imbo-uploader:imbo-uploader_00',
                'span' => 1,
            ),
        ),
        [
            'id' => 'godtImboUploaderQueue',
            'type' => 'graph',
            'params' => [
                'dao' => 'rabbitMQ',
                'metric' => 'queuedMessages',
                'title' => 'Elastic',
                'subtitle' => 'indexer',
                'span' => 2,
                'queueName' => 'imbo-uploader',
                'secondsBack' => '1200',
                'secondsIntervals' => '5',
                'refreshRate' => 5,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 10,
                'critical-value' => 25,
            ],
        ],
        array('id' => 'godtElasticIndexerProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'Elastic',
                'subtitle' => 'indexer',
                'processName' => 'elastica:elastica_00',
                'span' => 1,
            ),
        ),
        [
            'id' => 'godtElasticIndexerQueue',
            'type' => 'graph',
            'params' => [
                'dao' => 'rabbitMQ',
                'metric' => 'queuedMessages',
                'title' => 'Elastic',
                'subtitle' => 'indexer',
                'span' => 2,
                'queueName' => 'elastic-search',
                'secondsBack' => '1200',
                'secondsIntervals' => '5',
                'refreshRate' => 5,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 10,
                'critical-value' => 25,
            ],
        ],
        array('id' => 'godtEmailNotificationsProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'Notifications',
                'subtitle' => 'sender',
                'processName' => 'email-notifications:email-notifications_00',
                'span' => 1,
            ),
        ),
        [
            'id' => 'godtEmailNotifications',
            'type' => 'graph',
            'params' => [
                'dao' => 'rabbitMQ',
                'metric' => 'queuedMessages',
                'title' => 'Notifications',
                'subtitle' => 'sender',
                'span' => 2,
                'queueName' => 'email-notifications',
                'secondsBack' => '1200',
                'secondsIntervals' => '5',
                'refreshRate' => 5,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 10,
                'critical-value' => 25,
            ],
        ],
        array('id' => 'foodCpuUsageGraph',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'cpuUsage',
                'appId' => '1716240',
                'title' => 'CPU usage',
                'valueSuffix' => '%',
                'span' => 3,
                'beginDateTime' => '-60 minutes',
                'endDateTime' => 'now',
                'useThreshold' => 1,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 250,
                'critical-value' => 300,
            ),
        ),
        array('id' => 'foodMemory',
            'type' => 'incrementalGraph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'memory',
                'appId' => '1716240',
                'title' => 'Memory',
                'valueSuffix' => 'MB',
                'span' => 3,
                'refreshRate' => 10,
            ),
        ),


        array('id' => 'foodAverageResponseTimeGraph',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'averageResponseTime',
                'appId' => '1716240',
                'title' => 'Average response time',
                'span' => 3,
                'valueSuffix' => 'ms',
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now',
                'useThreshold' => 1,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 150,
                'critical-value' => 200,
            ),
        ),
        array('id' => 'foodFeRpm',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'feRpm',
                'appId' => '1716240',
                'span' => 3,
                'beginDateTime' => '-60 minutes',
                'endDateTime' => 'now',
                'title' => 'Frontend RPM',
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 5000,
                'critical-value' => 7500,
            ),
        ),
        array('id' => 'foodBeRpm',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'rpm',
                'appId' => '1716240',
                'span' => 3,
                'beginDateTime' => '-60 minutes',
                'endDateTime' => 'now',
                'title' => 'Backend RPM',
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 1000,
                'critical-value' => 1250,
            ),
        ),
        array('id' => 'foodErrorRate',
            'type' => 'incrementalGraph',
            'params' => array(
                'dao' => 'newRelic',
                'valueSuffix' => '%',
                'metric' => 'errorRate',
                'appId' => '1716240',
                'title' => 'Error Rate',
                'span' => 3,
                'useThreshold' => 1,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 0.5,
                'critical-value' => 2,
            ),
        ),
        array('id' => 'godtApdex',
            'type' => 'number',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'apdex',
                'appId' => '1716240',
                'title' => 'apdex',
                'span' => 2,
                'thresholdComparator' => 'higherIsBetter',
            ),
        ),


        array('id' => 'GodtWebBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Godt',
                'job' => 'godt.web',
                'metric' => 'status',
                'title' => 'Godt Web',
                'span' => 2,
            ),
        ),
        array('id' => 'GodtWebPRBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Godt',
                'job' => 'godt.web-pr',
                'metric' => 'status',
                'title' => 'Godt Web PR',
                'span' => 2,
            ),
        ),
        array('id' => 'GodtWebRediffBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Godt',
                'job' => 'godt.rediff',
                'metric' => 'status',
                'title' => 'Godt rediff',
                'span' => 2,
            ),
        ),
        array('id' => 'GodtApiBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Godt',
                'job' => 'godt.api',
                'metric' => 'status',
                'title' => 'Godt API',
                'span' => 2,
            ),
        ),
        array('id' => 'GodtApiPRBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Godt',
                'job' => 'godt.api-pr',
                'metric' => 'status',
                'title' => 'Godt API PR',
                'span' => 2,
            ),
        ),
        array('id' => 'godtCoreBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Godt',
                'job' => 'godt.core-pr',
                'metric' => 'status',
                'title' => 'Godt Core',
                'span' => 2,
            ),
        ),
        array('id' => 'godtAdminBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Godt',
                'job' => 'godt.admin',
                'metric' => 'status',
                'title' => 'Godt Admin',
                'span' => 2,
            ),
        ),

        array('id' => 'godtSatisBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Godt',
                'job' => 'godt.satis',
                'metric' => 'status',
                'title' => 'Godt Satis',
                'span' => 2,
            ),
        ),
    ),
);
