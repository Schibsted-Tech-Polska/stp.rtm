<?php
/**
 * Config for general view
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
        array('id' => 'messages',
            'type' => 'generalMessages',
            'params' => array(
                'dao' => 'events',
                'metric' => 'messages',
                'tplName' => 'general-messages',
                'limit' => 10,
                'title' => 'Latest activities',
            ),
        ),
        array('id' => 'vgtvFrontAverageResponseTimeGraph',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'averageResponseTime',
                'appId' => '53968',
                'title' => 'VGTV front',
                'subtitle' => 'average response time',
                'valueSuffix' => 'ms',
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now',
                'span' => 3
            ),
        ),
        array('id' => 'godtAverageResponseTimeGraph',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'averageResponseTime',
                'appId' => '1716240',
                'title' => 'godt.no',
                'subtitle' => 'average response time',
                'valueSuffix' => 'ms',
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now',
                'span' => 3
            ),
        ),

        array('id' => 'notifaveApdex',
            'type' => 'number',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'apdex',
                'appId' => '1716392',
                'title' => 'Notifave',
                'subtitle' => 'apdex',
            ),
        ),
        array('id' => 'vgtvCmsApiApdex',
            'type' => 'number',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'apdex',
                'appId' => '629297',
                'title' => 'VGTV CMS API',
                'subtitle' => 'apdex',
            ),
        ),
        array('id' => 'vgtvFrontApdex',
            'type' => 'number',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'apdex',
                'appId' => '53968',
                'title' => 'VGTV front',
                'subtitle' => 'apdex',
            ),
        ),
        array('id' => 'godtApdex',
            'type' => 'number',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'apdex',
                'appId' => '1716240',
                'title' => 'godt.no',
                'subtitle' => 'apdex',
            ),
        ),



        array('id' => 'notifaveErrorRate',
            'type' => 'error',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'errorRate',
                'appId' => '1716392',
                'title' => 'Notifave',
                'subtitle' => 'error rate',
                'valueSuffix' => '%',
                'thresholdComparator' => 'lowerIsBetter',
            ),
        ),
        array('id' => 'vgtvCmsApiErrorRate',
            'type' => 'error',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'errorRate',
                'appId' => '629297',
                'title' => 'VGTV CMS API',
                'subtitle' => 'error rate',
                'valueSuffix' => '%',
                'thresholdComparator' => 'lowerIsBetter',
            ),
        ),
        array('id' => 'vgtvFrontErrorRate',
            'type' => 'error',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'errorRate',
                'appId' => '53968',
                'title' => 'VGTV front',
                'subtitle' => 'error rate',
                'valueSuffix' => '%',
                'thresholdComparator' => 'lowerIsBetter',
            ),
        ),
        array('id' => 'godtErrorRate',
            'type' => 'error',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'errorRate',
                'appId' => '1716240',
                'title' => 'godt.no',
                'subtitle' => 'error rate',
                'valueSuffix' => '%',
                'thresholdComparator' => 'lowerIsBetter',
            ),
        ),

        array('id' => 'notifaveAverageResponseTimeGraph',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'averageResponseTime',
                'appId' => '1716392',
                'title' => 'Notifave',
                'subtitle' => 'average response time',
                'valueSuffix' => 'ms',
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now',
                'span' => 3
            ),
        ),
        array('id' => 'vgtvCmsApiAverageResponseTimeGraph',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'averageResponseTime',
                'appId' => '629297',
                'title' => 'VGTV CMS API',
                'subtitle' => 'average response time',
                'valueSuffix' => 'ms',
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now',
                'span' => 3
            ),
        ),
        array('id' => 'vgtvFrontRpm',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'rpm',
                'appId' => '53968',
                'title' => 'VGTV front',
                'subtitle' => 'RPM',
                'beginDateTime' => '-60 minutes',
                'endDateTime' => 'now',
                'span' => 3
            ),
        ),
        array('id' => 'godtRpm',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'rpm',
                'appId' => '1716240',
                'title' => 'godt.no',
                'subtitle' => 'RPM',
                'beginDateTime' => '-60 minutes',
                'endDateTime' => 'now',
                'span' => 3
            ),
        ),

        array('id' => 'notifaveCmsApiRpm',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'rpm',
                'appId' => '1716392',
                'title' => 'Notifave',
                'subtitle' => 'RPM',
                'beginDateTime' => '-60 minutes',
                'endDateTime' => 'now',
                'span' => 3
            ),
        ),
        array('id' => 'vgtvCmsApiRpm',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'rpm',
                'appId' => '629297',
                'title' => 'VGTV CMS API',
                'subtitle' => 'RPM',
                'beginDateTime' => '-60 minutes',
                'endDateTime' => 'now',
                'span' => 3
            ),
        ),
        array('id' => 'vgtvFrontFeRpm',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'feRpm',
                'appId' => '53968',
                'title' => 'VGTV front',
                'subtitle' => 'frontend RPM',
                'beginDateTime' => '-60 minutes',
                'endDateTime' => 'now',
                'span' => 3
            ),
        ),
        array('id' => 'godtFeRpm',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'feRpm',
                'appId' => '1716240',
                'title' => 'godt.no',
                'subtitle' => 'frontend RPM',
                'beginDateTime' => '-60 minutes',
                'endDateTime' => 'now',
                'span' => 3
            ),
        ),
    ),
);
