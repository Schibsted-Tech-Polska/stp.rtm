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
        array('id' => 'minmoteWeb',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'minmote',
                'job' => 'minmote.web',
                'metric' => 'status',
                'title' => 'MinMote Web',
                'span' => 2,
            ),
        ),
        array('id' => 'minmoteWebPR',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'minmote',
                'job' => 'minmote.web-pr',
                'metric' => 'status',
                'title' => 'MinMote Web PR',
                'span' => 2,
            ),
        ),
        array('id' => 'minmoteAdmin',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'minmote',
                'job' => 'minmote.admin',
                'metric' => 'status',
                'title' => 'MinMote admin',
                'span' => 2,
            ),
        ),
        array('id' => 'minmoteAdminPR',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'minmote',
                'job' => 'minmote.admin-pr',
                'metric' => 'status',
                'title' => 'MinMote admin PR',
                'span' => 2,
            ),
        ),
        array('id' => 'minmoteApi',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'minmote',
                'job' => 'minmote.api',
                'metric' => 'status',
                'title' => 'MinMote API',
                'span' => 2,
            ),
        ),
        array('id' => 'minmoteApiPR',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'minmote',
                'job' => 'minmote.api-pr',
                'metric' => 'status',
                'title' => 'MinMote API PR',
                'span' => 2,
            ),
        ),
        array('id' => 'minmoteCore',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'minmote',
                'job' => 'minmote.core',
                'metric' => 'status',
                'title' => 'MinMote Core',
                'span' => 2,
            ),
        ),
        array('id' => 'minmoteCorePR',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'minmote',
                'job' => 'minmote.core-pr',
                'metric' => 'status',
                'title' => 'MinMote Core PR',
                'span' => 2,
            ),
        ),
        array('id' => 'minmoteRediff',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'minmote',
                'job' => 'minmote.rediff',
                'metric' => 'status',
                'title' => 'MinMote Rediff',
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
                'useThreshold' => 1,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 2.5,
                'critical-value' => 5,
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
                'useThreshold' => 1,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 100,
                'critical-value' => 150,
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
                'useThreshold' => 1,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 4,
                'critical-value' => 6,
            ),
        ),
    ),
);
