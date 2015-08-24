<?php
/**
 * This is a sample project-specific NewRelic dashboard.
 * It consists of a all available NewRelic widgets for a single application.
 * All you have to do is replace variables surronded with '%' char with your data.
 */
return [
    'hipChat' => [
        'params' => [
            'auth_token' => '%HIPCHAT_AUTH_TOKEN%',
        ],
    ],
    'widgets' => [
        ['id' => 'messages',
            'type' => 'messages',
            'params' => [
                'dao' => 'hipChat',
                'metric' => 'listRecentMessages',
                'span' => 6,
                'subtitle' => '%ROOM_ID%',
                'title' => '',
                'limit' => 5,
                'room' => '%ROOM_ID%',
                'fromUser' => ['%USERNAME%'],
            ],
        ],
    ],
];
