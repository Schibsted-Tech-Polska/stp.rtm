<?php
/**
 * Config for rtm
 */
return array(
    'newRelic' => array(
        'headers' => array(
            'x-api-key' => '0116c7512e1efa28a39116312e9640edb90f1f52bb6ab30',
        ),
        'params' => array(
            'accountId' => '100366',
        ),
    ),
    'widgets' => array(
/*
    	array('id' => 'messages',
            'type' => 'messages',
            'params' => array(
                'dao' => 'events',
                'metric' => 'messages',
                'span' => 6,
                'title' => 'minmote',
                'limit' => 10,
            ),
        ),*/
        array('id' => 'minmoteAverageResponseTimeGraph',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'averageResponseTime',
                'appId' => '3662612',
                'title' => 'Average response time',
                'span' => 6,
                'valueSuffix' => 'ms',
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now',
            ),
        ),
        array('id' => 'minmotePollPlug',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'minmote-plugin-poll',
                'job' => 'minmote-plugin-poll',
                'metric' => 'status',
                'title' => 'MinMote Poll plugin',
            ),
        ),
        array('id' => 'minmoteWeb',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'minmote-web',
                'job' => 'minmote-web',
                'metric' => 'status',
                'title' => 'MinMote Web',
            ),
        ),
        array('id' => 'minmoteAdmin',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'minmote-admin',
                'job' => 'minmote-admin',
                'metric' => 'status',
                'title' => 'MinMote admin',
            ),
        ),
        array('id' => 'minmoteApi',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'minmote-api',
                'job' => 'minmote-api',
                'metric' => 'status',
                'title' => 'MinMote API',
            ),
        ),
        array('id' => 'minmoteCore',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'minmote-core',
                'job' => 'minmote-core',
                'metric' => 'status',
                'title' => 'MinMote Core Module',
            ),
        ),
        array('id' => 'minmotePediff',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'minmote-pediff',
                'job' => 'minmote-pediff',
                'metric' => 'status',
                'title' => 'MinMote Pediff',
            ),
        ),
        array('id' => 'minmoteCpuUsageGraph',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'cpuUsage',
                'appId' => '3662612',
                'title' => 'CPU usage',
                'valueSuffix' => '%',
                'span' => 3,
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now',
            ),
        ),
        array('id' => 'minmoteMemory',
            'type' => 'number',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'memory',
                'appId' => '3662612',
                'title' => 'Memory',
                'valueSuffix' => 'MB',
            ),
        ),
        array('id' => 'minmoteErrorRate',
            'type' => 'error',
            'params' => array(
                'dao' => 'newRelic',
                'valueSuffix' => '%',
                'metric' => 'errorRate',
                'appId' => '3662612',
                'title' => 'Error Rate',
            ),
        ),
        array('id' => 'minmoteApdex',
            'type' => 'number',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'apdex',
                'appId' => '3662612',
                'title' => 'apdex',
            ),
        ),
    ),
);
