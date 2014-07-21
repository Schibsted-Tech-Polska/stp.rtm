<?php
/**
 * This is a sample project-specific NewRelic dashboard.
 * It consists of a all available NewRelic widgets for a single application.
 * All you have to do is replace variables surronded with '%' char with your data.
 */
return array(
    'hipChat' => array(
        'params' => array(
            'auth_token' => '%HIPCHAT_AUTH_TOKEN%',
        ),
    ),
    'widgets' => array(
        array('id' => 'messages',
            'type' => 'messages',
            'params' => array(
                'dao' => 'hipChat',
                'metric' => 'listRecentMessages',
                'span' => 6,
                'subtitle' => '%ROOM_ID%',
                'title' => '',
                'limit' => 5,
                'room' => '%ROOM_ID%',
                'fromUser' => array('%USERNAME%'),
            ),
        ),
    ),
);
