<?php
/**
 * This is a sample project-specific Graphite dashboard.
 */
return [
    'graphite' => [
        'params' => [
            'graphiteUrl' => '%GRAPHITE_URL%',
        ],
    ],
    'widgets' => [
        ['id' => 'widget',
            'type' => 'graph',
            'params' => [
                'dao' => 'graphite',
                'metric' => 'data',
                'target' => '%GRAPHITE_TARGET_QUERY%',
                'title' => '%WIDGET_TITLE%',
                'span' => 3,
                'from' => '-30min', //graphite specific format
                'until' => '-0hour', //graphite specific format
            ],
        ],
    ],
];
