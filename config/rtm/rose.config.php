<?php
/**
 * Config for rtm
 */
return array(
    'jenkins' => array(
        'params' => array(
            'baseUrl' => 'http://ci.vgnett.no/',
        ),
    ),
    'widgets' => array(
        array('id' => 'messagesRose',
            'type' => 'messages',
            'params' => array(
                'dao' => 'events',
                'metric' => 'messages',
                'span' => 6,
                'title' => 'Rose',
                'limit' => 10,
                'projectName' => 'rose',
            ),
        ),
        array('id' => 'roseBuildStatusDevelop',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Rose_v2',
                'job' => 'Rose_v2_develop',
                'metric' => 'status',
                'title' => 'Rose Build (develop)',
                'refreshRate' => 5,
            ),
        ),
    ),
);
