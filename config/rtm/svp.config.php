<?php
$appIds = [
    'PROD ALL' => 10378083,
    'STAGE ALL' => 14768292,
    'VGTV' => 15084810,
    'AP' => 15084812,
    'BT' => 15084825,
    'FVN' => 15084818,
    'SA' => 15084822,
    'AB' => 15085005,
    'VGTV STAGE' => 15070860,
    'AP STAGE' => 15075013,
    'BT STAGE' => 15075015,
    'AB STAGE' => 15070884,
//    'SA STAGE' => 15075021,
//    'FVN STAGE' => 15071188,
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
                    'subtitle' => 'CPU USAGE',
                    'title' => $label,
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
                    'title' => $label,
                    'subtitle' => 'AVG RESP TIME',
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
                    'subtitle' => 'RPM',
                    'title' => $label,
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
                    'subtitle' => 'ERROR RATE',
                    'title' => $label,
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
