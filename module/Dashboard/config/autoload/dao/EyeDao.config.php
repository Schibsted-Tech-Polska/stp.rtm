<?php
return [
    'EyeDao' => [
        'urls' => [
            'fetchInfoForEyeWidget' => ':eyeUrl:/api/info?filter=all',
            'fetchInfoForProcessWidget' => ':eyeUrl:/api/info?filter=:processName:',
        ],
    ],
];
