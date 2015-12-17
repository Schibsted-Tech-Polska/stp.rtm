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
    'TEST' => 15075015,
    'TEST2' => 15075015,
    'TEST3' => 15075015,
    'TEST4' => 15075015,
];

function getWidgetsConfigs($appId, $label, $key)
{
    $span = 1;

    return
        [
            $key => [
                'id' => 'svpApiProdCpuUsage' . $appId . $key,
                'type' => 'graph',
                'params' => [
                    'dao' => 'newRelic',
                    'metric' => 'cpuUsage',
                    'appId' => $appId,
                    'subtitle' => $label,
                    'title' => 'CPU USAGE',
                    'valueSuffix' => '%',
                    'span' => $span,
                    'beginDateTime' => '-30 minutes',
                    'endDateTime' => 'now',
                ],
            ],
            $key + 100 => [
                'id' => 'svpApiProdAvgResponse' . $appId . $key,
                'type' => 'graph',
                'params' => [
                    'dao' => 'newRelic',
                    'metric' => 'averageResponseTime',
                    'appId' => $appId,
                    'title' => 'AVG RESP TIME',
                    'subtitle' => $label,
                    'span' => $span,
                    'valueSuffix' => 'ms',
                    'beginDateTime' => '-30 minutes',
                    'endDateTime' => 'now',
                ],
            ],
            $key + 200 => [
                'id' => 'svpApiRpm' . $appId . $key,
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
                    'span' => $span,
                ],
            ],
            $key + 300 => [
                'id' => 'svpProdErrorRate' . $appId . $key,
                'type' => 'error',
                'params' => [
                    'dao' => 'newRelic',
                    'metric' => 'errorRate',
                    'appId' => $appId,
                    'title' => 'ERROR RATE',
                    'subtitle' => $label,
                    'valueSuffix' => '%',
                    'span' => $span,
                    'thresholdComparator' => 'lowerIsBetter',
                ],
            ],
        ];
}

$widgets = [];
$row = 0;
foreach ($appIds as $label => $appId) {
    $widgets += getWidgetsConfigs($appId, $label, $row++);
}

ksort($widgets);

/**
 * Config for rtm
 */
return [
    'theme' => ['tv', 'dark'],
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
