<?php
/**
 * This is a sample single project-plan Bamboo dashboard.
 * It consists of a single widget for a single build.
 * Bamboo project and plan names can be easily obtained using for example Bamboo dashboard.
 */
return [
    'bamboo' => [
        'headers' => [
            'Accept' => 'application/json',
        ],
        'params' => [
            'username' => 'username',
            'password' => 'password',
            'baseUrl' => '%BASE_URL%',
        ],
    ],
    'widgets' => [
        ['id' => '%WIDGET_ID%',
            'type' => 'build',
            'params' => [
                'dao' => 'bamboo',
                'project' => '%BAMBOO_PROJECT%',
                'plan' => '%BAMBOO_PLAN_NAME%',
                'metric' => 'status',
                'title' => 'Sample project build',
            ],
        ],
    ],
];
