<?php
return [
    'SlackDao' => [
        'urls' => [
            'fetchListRecentMessagesForSlackWidget' =>
                'https://slack.com/api/channels.history?token=:token:&channel=:channel:&count=:count:',
            'fetchUserInfo' =>
                'https://slack.com/api/users.info?token=:token:&user=:userId:',
            'fetchEmoji' =>
                'https://slack.com/api/emoji.list?token=:token:',
        ],
    ],
];
