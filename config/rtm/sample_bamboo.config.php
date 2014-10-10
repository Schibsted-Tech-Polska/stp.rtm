<?php
/**
 * This is a sample single project-plan Bamboo dashboard.
 * It consists of a single widget for a single build.
 * Bamboo project and plan names can be easily obtained using for example Bamboo dashboard.
 */
return array(
    'bamboo' => array(
        'headers' => array(
            'Accept' => 'application/json'
        ),
        'params' => array(
            'username' => 'username',
            'password' => 'password',
            'baseUrl' => '%BASE_URL%'
        ),
    ),
    'widgets' => array(
        array('id' => '%WIDGET_ID%',
            'type' => 'build',
            'params' => array(
                'dao' => 'bamboo',
                'project' => '%BAMBOO_PROJECT%',
                'plan' => '%BAMBOO_PLAN_NAME%',
                'metric' => 'status',
                'title' => 'Sample project build',
            ),
        ),
    ),
);
