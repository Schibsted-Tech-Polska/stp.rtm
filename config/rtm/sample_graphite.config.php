<?php
/**
 * This is a sample project-specific Graphite dashboard.
 */
return array(
    'graphite' => array(
        'params' => array(
            'graphiteUrl' => '%GRAPHITE_URL%',
        ),
    ),
    'widgets' => array(
        array('id' => 'widget',
            'type' => 'graph',
            'params' => array(
                'dao' => 'graphite',
                'metric' => 'data',
                'target' => '%GRAPHITE_TARGET_QUERY%',
                'title' => '%WIDGET_TITLE%',
                'span' => 3,
                'from' => '-30min', //graphite specific format
                'until' => '-0hour', //graphite specific format
            ),
        ),
    ),
);
