<?php
/**
 * Default config of all widgets
 */
return [
    'widgetsConfig' => [
        'number' => [
            'refreshRate' => 60,
            'title' => '',
            'subtitle' => '',
            'valueSuffix' => '',
            'valuePrefix' => '',
            'span' => 3,
            'useThreshold' => 0,
        ],
        'numberWithNewRelicThreshold' => [
            'refreshRate' => 60,
            'title' => '',
            'subtitle' => '',
            'valueSuffix' => '',
            'valuePrefix' => '',
            'span' => 3,
        ],
        'gearman' => [
            'refreshRate' => 5,
            'title' => '',
            'subtitle' => '',
            'valueSuffix' => '',
            'valuePrefix' => '',
            'span' => 3,
        ],
        'rabbitMQ' => [
            'refreshRate' => 5,
            'title' => '',
            'subtitle' => '',
            'valueSuffix' => '',
            'valuePrefix' => '',
            'span' => 3,
        ],
        'rabbitMemory' => [
            'refreshRate' => 5,
            'title' => '',
            'subtitle' => '',
            'valueSuffix' => '',
            'valuePrefix' => '',
            'span' => 2,
        ],
        'eye' => [
            'refreshRate' => 5,
            'title' => '',
            'subtitle' => '',
            'valueSuffix' => '',
            'valuePrefix' => '',
            'span' => 3,
        ],
        'process' => [
            'refreshRate' => 5,
            'title' => '',
            'subtitle' => '',
            'valueSuffix' => '',
            'valuePrefix' => '',
            'span' => 3,
        ],
        'error' => [
            'refreshRate' => 60,
            'title' => '',
            'subtitle' => '',
            'valueSuffix' => '',
            'valuePrefix' => '',
            'span' => 3,
            'useThreshold' => 0,
        ],
        'build' => [
            'refreshRate' => 10,
            'title' => '',
            'subtitle' => '',
            'valueSuffix' => '',
            'valuePrefix' => '',
            'span' => 3,
        ],
        'text' => [
            'refreshRate' => 60,
            'span' => 3,
            'title' => '',
            'subtitle' => '',
        ],
        'messages' => [
            'refreshRate' => 10,
            'title' => '',
            'subtitle' => '',
            'span' => 6,
        ],
        'generalMessages' => [
            'refreshRate' => 10,
            'title' => '',
            'subtitle' => '',
            'span' => 6,
        ],
        'graph' => [
            'refreshRate' => 60,
            'title' => '',
            'subtitle' => '',
            'valueSuffix' => '',
            'valuePrefix' => '',
            'span' => 3,
            'useThreshold' => 0,
        ],
        'incrementalGraph' => [
            'refreshRate' => 60,
            'title' => '',
            'subtitle' => '',
            'valueSuffix' => '',
            'valuePrefix' => '',
            'span' => 3,
            'useThreshold' => 0,
            'maxPoints' => 20,
            'graphType' => 'spline',
            'graphTickPixelInterval' => 150,
        ],
        'alert' => [
            'refreshRate' => 60,
            'title' => '',
            'subtitle' => '',
            'span' => 3,
        ],
        'image' => [
            'refreshRate' => 60,
            'title' => '',
            'subtitle' => '',
            'span' => 3,
        ],
        'smog' => [
            'refreshRate' => 60,
            'title' => '',
            'subtitle' => '',
            'span' => 3,
        ],
        'weather' => [
            'refreshRate' => 900,
            'title' => 'Weather',
            'subtitle' => '',
            'span' => 3
        ],
        'herokuStatus' => [
            'refreshRate' => 60,
            'title' => 'Heroku Status',
            'subtitle' => '',
            'span' => 3
        ]
    ],
];
