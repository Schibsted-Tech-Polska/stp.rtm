<?php
/**
 * @author: Damian Rawski <damian.rawski@schibsted.pl>
 */

return [
    'HipChatDao' => [
        'urls' => [
            'listRecentMessages' =>
                'https://api.hipchat.com/v1/rooms/history?auth_token=:auth_token:&room_id=:room_id:&date=recent',
            'newListRecentMessages' =>
                'https://api.hipchat.com/v2/room/:room_id:/history?auth_token=:auth_token:',
            'fetchUserInfo' =>
                'https://api.hipchat.com/v2/user/:userId:?auth_token=:auth_token:',
        ],
    ],
];
