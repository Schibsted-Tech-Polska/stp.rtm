<?php

$appIds = [
    'API PROD' => 10378083,
    'API STAGE' => 14768292,
    'API STAGE VGTV' => 15070860,
    'API STAGE AB' => 15070884,
    'API STAGE FVN' => 15071188,
    'API STAGE AP' => 15075013,
    'API STAGE SA' => 15075021,
    'API STAGE BT' => 15075015,
];

function getWidgetsConfigs($appId, $label)
{
    return
        [
            [
                'id' => 'svpApiProdCpuUsage' . $appId,
                'type' => 'graph',
                'params' => [
                    'dao' => 'newRelic',
                    'metric' => 'cpuUsage',
                    'appId' => $appId,
                    'subtitle' => $label,
                    'title' => 'CPU USAGE',
                    'valueSuffix' => '%',
                    'span' => 3,
                    'beginDateTime' => '-30 minutes',
                    'endDateTime' => 'now',
                ],
            ],
            [
                'id' => 'svpApiProdAvgResponse' . $appId,
                'type' => 'graph',
                'params' => [
                    'dao' => 'newRelic',
                    'metric' => 'averageResponseTime',
                    'appId' => $appId,
                    'title' => 'AVG RESP TIME',
                    'subtitle' => $label,
                    'span' => 3,
                    'valueSuffix' => 'ms',
                    'beginDateTime' => '-30 minutes',
                    'endDateTime' => 'now',
                ],
            ],
            [
                'id' => 'svpApiRpm' . $appId,
                'type' => 'graph',
                'params' => [
                    'dao' => 'newRelic',
                    'metric' => 'rpm',
                    'appId' => $appId,
                    'subtitle' => $label,
                    'title' => 'RPM',
                    'beginDateTime' => '-60 minutes',
                    'valueSuffix' => '&nbsp;',
                    'endDateTime' => 'now',
                    'span' => 3
                ],
            ],
            [
                'id' => 'svpProdErrorRate' . $appId,
                'type' => 'error',
                'params' => [
                    'dao' => 'newRelic',
                    'metric' => 'errorRate',
                    'appId' => $appId,
                    'title' => 'ERROR RATE',
                    'subtitle' => $label,
                    'valueSuffix' => '%',
                    'span' => 3,
                    'thresholdComparator' => 'lowerIsBetter',
                ],
            ],
        ];
}

$widgets = [];
foreach ($appIds as $label => $appId) {
    $widgets = array_merge($widgets, getWidgetsConfigs($appId, $label));
}

/**
 * Config for rtm
 */
return [
    'newRelic' => [
        'headers' => [
            'x-api-key' => '0116c7512e1efa28a39116312e9640edb90f1f52bb6ab30',
        ],
        'params' => [
            'accountId' => '100366',
        ],
    ],
    'vgtv' => [
        'headers' => [
            'Accept' => 'application/hal+json',
        ],
    ],
    'widgets' => $widgets
];
