<?php
/**
 * This is a sample project-specific NewRelic dashboard.
 * It consists of a all available NewRelic widgets for a single application.
 * All you have to do is replace variables surronded with '%' char with your data.
 */
return [
    'newRelic' => [
        'headers' => [
            'x-api-key' => '%X_API_KEY%',
        ],
        'params' => [
            'accountId' => '%ACCOUNT_ID%',
            'appId' => '%APPLICATION_ID%',
        ],
    ],
    'widgets' => [
        ['id' => 'messages',
            'type' => 'messages',
            'params' => [
                'dao' => 'events',
                'metric' => 'messages',
                'span' => 6,
                'title' => 'Sample project',
                'limit' => 10,
            ],
        ],
        ['id' => '%WIDGET_ID_1%',
            'type' => 'graph',
            'params' => [
                'dao' => 'newRelic',
                'metric' => 'feRpm',
                'span' => 3,
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now',
                'title' => 'Frontend RPM',
            ],
        ],
        ['id' => '%WIDGET_ID_2%',
            'type' => 'graph',
            'params' => [
                'dao' => 'newRelic',
                'metric' => 'rpm',
                'span' => 6,
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now',
                'title' => 'Backend RPM',
            ],
        ],

        ['id' => '%WIDGET_ID_2%',
            'type' => 'graph',
            'params' => [
                'dao' => 'newRelic',
                'metric' => 'cpuUsage',
                'title' => 'CPU USAGE',
                'valueSuffix' => '%',
                'span' => 6,
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now',
            ],
        ],
        ['id' => '%WIDGET_ID_3%',
            'type' => 'graph',
            'params' => [
                'dao' => 'newRelic',
                'metric' => 'averageResponseTime',
                'title' => 'Average response time',
                'span' => 6,
                'valueSuffix' => 'ms',
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now',
            ],
        ],

        ['id' => '%WIDGET_ID_4%',
            'type' => 'number',
            'params' => [
                'dao' => 'newRelic',
                'metric' => 'memory',
                'title' => 'MEMORY',
                'valueSuffix' => 'MB',
            ],
        ],
        ['id' => '%WIDGET_ID_5%',
            'type' => 'numberWithNewRelicThreshold',
            'params' => [
                'dao' => 'newRelic',
                'metric' => 'apdex',
                'title' => 'Apdex',
                'thresholdComparator' => 'higherIsBetter',
            ],
        ],
        ['id' => '%WIDGET_ID_6%',
            'type' => 'error',
            'params' => [
                'dao' => 'newRelic',
                'valueSuffix' => '%',
                'metric' => 'errorRate',
                'title' => 'ERROR RATE',
                'thresholdComparator' => 'lowerIsBetter',
            ],
        ],
    ],
];
