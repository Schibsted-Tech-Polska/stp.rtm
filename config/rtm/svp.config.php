<?php
$appIds = [
    $prodAll = ['label' => 'PROD ALL', 'id' => 10378083],
    $vgtv = ['label' => 'VGTV', 'id' => 15084810],
    $ap = ['label' => 'AP', 'id' => 15084812],
    $bt = ['label' => 'BT', 'id' => 15084825],
    $fvn = ['label' => 'FVN', 'id' => 15084818],
    $sa = ['label' => 'SA', 'id' => 15084822],
    $ab = ['label' => 'AB', 'id' => 15085005],
    $vgtvs = ['label' => 'VGTV-S', 'id' => 15084820],
    $stageAll = ['label' => 'STAGE ALL', 'id' => 14768292],
    $apStage = ['label' => 'STAGE AP', 'id' => 15075013],
    $btStage = ['label' => 'STAGE BT', 'id' => 15075015],
    $abStage = ['label' => 'STAGE AB', 'id' => 15070884],
    $vgtvStage = ['label' => 'STAGE VGTV', 'id' => 15070860],

    'SA STAGE' => 15075021,
    'FVN STAGE' => 15071188,
];


$widgets = [
    // ROW 1
    ['id' => 'svpApiProdCpuUsage' . $prodAll['id'], 'type' => 'graph', 'params' => ['span' => 6, 'dao' => 'newRelic', 'metric' => 'cpuUsage', 'appId' => $prodAll['id'], 'subtitle' => 'CPU USAGE', 'title' => $prodAll['label'], 'valueSuffix' => '%', 'beginDateTime' => '-30 minutes', 'endDateTime' => 'now',],],
    ['id' => 'svpApiProdCpuUsage' . $stageAll['id'], 'type' => 'graph', 'params' => ['span' => 2, 'dao' => 'newRelic', 'metric' => 'cpuUsage', 'appId' => $stageAll['id'], 'subtitle' => 'CPU USAGE', 'title' => $stageAll['label'], 'valueSuffix' => '%', 'beginDateTime' => '-30 minutes', 'endDateTime' => 'now',],],
    ['id' => 'VGTV_v2_api_develop', 'type' => 'build', 'params' => ['span' => 1, 'dao' => 'jenkins', 'job' => 'SVP/job/api/job/api-develop-new', 'metric' => 'status', 'title' => 'SVP API DEVELOP',],],
    ['id' => 'VGTV_v2_smoke_tests', 'type' => 'build', 'params' => ['span' => 1, 'dao' => 'jenkins', 'job' => 'svp-api-smoke-tests-STAGING', 'metric' => 'status', 'title' => 'SVP SMOKE STAGE',],],
    ['id' => 'SVP_v2_smoke_tests', 'type' => 'build', 'params' => ['span' => 1, 'dao' => 'jenkins', 'job' => 'svp-api-smoke-tests-PRODUCTION', 'metric' => 'status', 'title' => 'SVP SMOKE PROD',],],
    ['id' => 'vgtv2apiProductionBuild', 'type' => 'build', 'params' => ['span' => 1, 'dao' => 'jenkins', 'job' => 'SVP/job/api/job/api-master', 'metric' => 'status', 'title' => 'SVP API MASTER',],],

    // ROW 2
    ['id' => 'svpApiRpm' . $prodAll['id'], 'type' => 'graph', 'params' => ['span' => 3, 'dao' => 'newRelic', 'metric' => 'rpm', 'appId' => $prodAll['id'], 'subtitle' => 'RPM', 'title' => $prodAll['label'], 'beginDateTime' => '-60 minutes', 'valueSuffix' => '&nbsp;', 'endDateTime' => 'now'],],
    ['id' => 'svpApiRpm' . $vgtv['id'], 'type' => 'graph', 'params' => ['span' => 3, 'dao' => 'newRelic', 'metric' => 'rpm', 'appId' => $vgtv['id'], 'subtitle' => 'RPM', 'title' => $vgtv['label'], 'beginDateTime' => '-60 minutes', 'valueSuffix' => '&nbsp;', 'endDateTime' => 'now'],],
    ['id' => 'svpApiRpm' . $ap['id'], 'type' => 'graph', 'params' => ['span' => 2, 'dao' => 'newRelic', 'metric' => 'rpm', 'appId' => $ap['id'], 'subtitle' => 'RPM', 'title' => $ap['label'], 'beginDateTime' => '-60 minutes', 'valueSuffix' => '&nbsp;', 'endDateTime' => 'now'],],
    ['id' => 'svpApiRpm' . $bt['id'], 'type' => 'graph', 'params' => ['span' => 2, 'dao' => 'newRelic', 'metric' => 'rpm', 'appId' => $bt['id'], 'subtitle' => 'RPM', 'title' => $bt['label'], 'beginDateTime' => '-60 minutes', 'valueSuffix' => '&nbsp;', 'endDateTime' => 'now'],],
    ['id' => 'svpApiRpm' . $fvn['id'], 'type' => 'graph', 'params' => ['span' => 1, 'dao' => 'newRelic', 'metric' => 'rpm', 'appId' => $fvn['id'], 'subtitle' => 'RPM', 'title' => $fvn['label'], 'beginDateTime' => '-60 minutes', 'valueSuffix' => '&nbsp;', 'endDateTime' => 'now'],],
    ['id' => 'svpApiRpm' . $sa['id'], 'type' => 'graph', 'params' => ['span' => 1, 'dao' => 'newRelic', 'metric' => 'rpm', 'appId' => $sa['id'], 'subtitle' => 'RPM', 'title' => $sa['label'], 'beginDateTime' => '-60 minutes', 'valueSuffix' => '&nbsp;', 'endDateTime' => 'now'],],

    // ROW 3
    ['id' => 'svpApiProdAvgResponse' . $prodAll['id'], 'type' => 'graph', 'params' => ['span' => 2, 'dao' => 'newRelic', 'metric' => 'averageResponseTime', 'appId' => $prodAll['id'], 'title' => $prodAll['label'], 'subtitle' => 'AVG RESP TIME', 'valueSuffix' => 'ms', 'beginDateTime' => '-30 minutes', 'endDateTime' => 'now',],],
    ['id' => 'svpApiProdAvgResponse' . $vgtv['id'], 'type' => 'graph', 'params' => ['span' => 2, 'dao' => 'newRelic', 'metric' => 'averageResponseTime', 'appId' => $vgtv['id'], 'title' => $vgtv['label'], 'subtitle' => 'AVG RESP TIME', 'valueSuffix' => 'ms', 'beginDateTime' => '-30 minutes', 'endDateTime' => 'now',],],
    ['id' => 'svpApiProdAvgResponse' . $ap['id'], 'type' => 'graph', 'params' => ['span' => 2, 'dao' => 'newRelic', 'metric' => 'averageResponseTime', 'appId' => $ap['id'], 'title' => $ap['label'], 'subtitle' => 'AVG RESP TIME', 'valueSuffix' => 'ms', 'beginDateTime' => '-30 minutes', 'endDateTime' => 'now',],],
    ['id' => 'svpApiProdAvgResponse' . $bt['id'], 'type' => 'graph', 'params' => ['span' => 2, 'dao' => 'newRelic', 'metric' => 'averageResponseTime', 'appId' => $bt['id'], 'title' => $bt['label'], 'subtitle' => 'AVG RESP TIME', 'valueSuffix' => 'ms', 'beginDateTime' => '-30 minutes', 'endDateTime' => 'now',],],
    ['id' => 'svpApiProdAvgResponse' . $fvn['id'], 'type' => 'graph', 'params' => ['span' => 1, 'dao' => 'newRelic', 'metric' => 'averageResponseTime', 'appId' => $fvn['id'], 'title' => $fvn['label'], 'subtitle' => 'AVG RESP TIME', 'valueSuffix' => 'ms', 'beginDateTime' => '-30 minutes', 'endDateTime' => 'now',],],
    ['id' => 'svpApiProdAvgResponse' . $sa['id'], 'type' => 'graph', 'params' => ['span' => 1, 'dao' => 'newRelic', 'metric' => 'averageResponseTime', 'appId' => $sa['id'], 'title' => $sa['label'], 'subtitle' => 'AVG RESP TIME', 'valueSuffix' => 'ms', 'beginDateTime' => '-30 minutes', 'endDateTime' => 'now',],],
    ['id' => 'svpApiProdAvgResponse' . $ab['id'], 'type' => 'graph', 'params' => ['span' => 1, 'dao' => 'newRelic', 'metric' => 'averageResponseTime', 'appId' => $ab['id'], 'title' => $ab['label'], 'subtitle' => 'AVG RESP TIME', 'valueSuffix' => 'ms', 'beginDateTime' => '-30 minutes', 'endDateTime' => 'now',],],
    ['id' => 'svpApiProdAvgResponse' . $stageAll['id'], 'type' => 'graph', 'params' => ['span' => 1, 'dao' => 'newRelic', 'metric' => 'averageResponseTime', 'appId' => $stageAll['id'], 'title' => $stageAll['label'], 'subtitle' => 'AVG RESP TIME', 'valueSuffix' => 'ms', 'beginDateTime' => '-30 minutes', 'endDateTime' => 'now',],],

    // ROW 4
    ['id' => 'svpProdErrorRate' . $prodAll['id'], 'type' => 'error', 'params' => ['span' => 2, 'dao' => 'newRelic', 'metric' => 'errorRate', 'appId' => $prodAll['id'], 'subtitle' => 'ERROR RATE', 'title' => $prodAll['label'], 'valueSuffix' => '%', 'thresholdComparator' => 'lowerIsBetter',],],
    ['id' => 'svpProdErrorRate' . $vgtv['id'], 'type' => 'error', 'params' => ['span' => 1, 'dao' => 'newRelic', 'metric' => 'errorRate', 'appId' => $vgtv['id'], 'subtitle' => 'ERROR RATE', 'title' => $vgtv['label'], 'valueSuffix' => '%', 'thresholdComparator' => 'lowerIsBetter',],],
    ['id' => 'svpProdErrorRate' . $ap['id'], 'type' => 'error', 'params' => ['span' => 1, 'dao' => 'newRelic', 'metric' => 'errorRate', 'appId' => $ap['id'], 'subtitle' => 'ERROR RATE', 'title' => $ap['label'], 'valueSuffix' => '%', 'thresholdComparator' => 'lowerIsBetter',],],
    ['id' => 'svpProdErrorRate' . $bt['id'], 'type' => 'error', 'params' => ['span' => 1, 'dao' => 'newRelic', 'metric' => 'errorRate', 'appId' => $bt['id'], 'subtitle' => 'ERROR RATE', 'title' => $bt['label'], 'valueSuffix' => '%', 'thresholdComparator' => 'lowerIsBetter',],],
    ['id' => 'svpProdErrorRate' . $fvn['id'], 'type' => 'error', 'params' => ['span' => 1, 'dao' => 'newRelic', 'metric' => 'errorRate', 'appId' => $fvn['id'], 'subtitle' => 'ERROR RATE', 'title' => $fvn['label'], 'valueSuffix' => '%', 'thresholdComparator' => 'lowerIsBetter',],],
    ['id' => 'svpProdErrorRate' . $sa['id'], 'type' => 'error', 'params' => ['span' => 1, 'dao' => 'newRelic', 'metric' => 'errorRate', 'appId' => $sa['id'], 'subtitle' => 'ERROR RATE', 'title' => $sa['label'], 'valueSuffix' => '%', 'thresholdComparator' => 'lowerIsBetter',],],
    ['id' => 'svpProdErrorRate' . $ab['id'], 'type' => 'error', 'params' => ['span' => 1, 'dao' => 'newRelic', 'metric' => 'errorRate', 'appId' => $ab['id'], 'subtitle' => 'ERROR RATE', 'title' => $ab['label'], 'valueSuffix' => '%', 'thresholdComparator' => 'lowerIsBetter',],],
    ['id' => 'svpProdErrorRate' . $vgtvs['id'], 'type' => 'error', 'params' => ['span' => 1, 'dao' => 'newRelic', 'metric' => 'errorRate', 'appId' => $vgtvs['id'], 'subtitle' => 'ERROR RATE', 'title' => $vgtvs['label'], 'valueSuffix' => '%', 'thresholdComparator' => 'lowerIsBetter',],],
    ['id' => 'svpProdErrorRate' . $stageAll['id'], 'type' => 'error', 'params' => ['span' => 1, 'dao' => 'newRelic', 'metric' => 'errorRate', 'appId' => $stageAll['id'], 'subtitle' => 'ERROR RATE', 'title' => $stageAll['label'], 'valueSuffix' => '%', 'thresholdComparator' => 'lowerIsBetter',],],
    ['id' => 'svpProdErrorRate' . $vgtvStage['id'], 'type' => 'error', 'params' => ['span' => 1, 'dao' => 'newRelic', 'metric' => 'errorRate', 'appId' => $vgtvStage['id'], 'subtitle' => 'ERROR RATE', 'title' => $vgtvStage['label'], 'valueSuffix' => '%', 'thresholdComparator' => 'lowerIsBetter',],],
    ['id' => 'svpProdErrorRate' . $abStage['id'], 'type' => 'error', 'params' => ['span' => 1, 'dao' => 'newRelic', 'metric' => 'errorRate', 'appId' => $abStage['id'], 'subtitle' => 'ERROR RATE', 'title' => $abStage['label'], 'valueSuffix' => '%', 'thresholdComparator' => 'lowerIsBetter',],],
];

/**
 * Config for rtm
 */
return [
    'theme' => ['tv', 'dark'],
    'jenkins' => [
        'params' => [
            'baseUrl' => 'http://ci.vgnett.no/',
        ],
    ],
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
