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
    'jenkins' => array(
        'params' => array(
            'baseUrl' => 'http://ci.vgnett.no/',
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
        array('id' => 'minmotePollPlug',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'minmote-plugin-poll',
                'job' => 'minmote-plugin-poll',
                'metric' => 'status',
                'title' => 'MinMote Poll plugin',
                'span' => 2,
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
                'span' => 2,
            ),
        ),
        array('id' => 'minmoteWebDevelop',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'minmote-web-develop',
                'job' => 'minmote-web-develop',
                'metric' => 'status',
                'title' => 'MinMote Web DEVELOP',
                'span' => 2,
            ),
        ),
        array('id' => 'minmoteAdmin',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'minmote',
                'job' => 'minmote-admin',
                'metric' => 'status',
                'title' => 'MinMote admin',
                'span' => 2,
            ),
        ),
        array('id' => 'minmoteAdminDevelop',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'minmote',
                'job' => 'minmote-admin-develop',
                'metric' => 'status',
                'title' => 'MinMote admin DEVELOP',
                'span' => 2,
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
                'span' => 2,
            ),
        ),
        array('id' => 'minmoteApiDevelop',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'minmote-api-develop',
                'job' => 'minmote-api-develop',
                'metric' => 'status',
                'title' => 'MinMote API DEVELOP',
                'span' => 2,
            ),
        ),
        array('id' => 'minmoteCore',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'minmote-core',
                'job' => 'minmote-core',
                'metric' => 'status',
                'title' => 'MinMote Core',
                'span' => 2,
            ),
        ),
        array('id' => 'minmoteCoreDevelop',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'minmote-core-develop',
                'job' => 'minmote-core-develop',
                'metric' => 'status',
                'title' => 'MinMote Core DEVELOP',
                'span' => 2,
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
                'span' => 2,
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
                'span' => 2,
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
                'span' => 2,
            ),
        ),
        array('id' => 'minmoteFeRpm',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'feRpm',
                'appId' => '3662612',
                'span' => 3,
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now',
                'title' => 'Frontend RPM',
                'thresholdComparator' => 'higherIsBetter',
            ),
        ),
        array('id' => 'minmoteBeRpm',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'rpm',
                'appId' => '3662612',
                'span' => 3,
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now',
                'title' => 'Backend RPM',
                'thresholdComparator' => 'higherIsBetter',
            ),
        ),
        array('id' => 'minmoteAverageResponseTimeGraph',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'averageResponseTime',
                'appId' => '3662612',
                'title' => 'Average response time',
                'span' => 3,
                'valueSuffix' => 'ms',
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now',
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
        array('id' => 'minmoteApdex',
            'type' => 'number',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'apdex',
                'appId' => '3662612',
                'title' => 'apdex',
                'span' => 2,
            ),
        ),
        array('id' => 'minmoteRenderRpmGraph',
            'type' => 'graph',
            'params' => array(
                'dao' => 'graphite',
                'metric' => 'data',
                'target' => 'movingAverage(nonNegativeDerivative(vg-render-01.tail-MinMote.counter-RequestsServed),5)',
                'title' => 'Render RPM',
                'span' => 3,
                'from' => '-30min',
                'until' => '-0hour',
            ),
        ),
        array('id' => 'minmoteRenderAvgRspTimeGraph',
            'type' => 'graph',
            'params' => array(
                'dao' => 'graphite',
                'metric' => 'data',
                'target' => 'movingAverage(vg-render-01.tail-MinMote.response_time-AvgResponseTime,5)',
                'valueSuffix' => 's',
                'title' => 'Render Average Response time',
                'span' => 3,
                'from' => '-30min',
                'until' => '-0hour',
            ),
        ),
    ),
);
