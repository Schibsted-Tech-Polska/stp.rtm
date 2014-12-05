<?php
/**
 * Config for rtm
 */
return array(
    'newRelic' => array(
        'headers' => array(
            'x-api-key' => '0116c7512e1efa28a39116312e9640edb90f1f52bb6ab30'
        ),
        'params' => array(
            'accountId' => '100366'
        )
    ),
    'widgets' => array(
        array('id' => 'messagesRose',
            'type' => 'messages',
            'params' => array(
                'dao' => 'events',
                'metric' => 'messages',
                'span' => '6', // widget width, accepted values: 1-12
                'title' => 'Rose', // string title
                'limit' => 10,
                'projectName' => 'rose'
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
                'config' => 'roseStatus500',
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
                'config' => 'roseE24Status500',
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
                'config' => 'roseStageStatus500',
                'span' => 4,
            ),
        ),
     ),
);
