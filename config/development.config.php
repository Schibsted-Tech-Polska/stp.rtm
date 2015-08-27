<?php
ini_set('display_errors', 1);
ini_set('log_errors', 0);

return [
    'modules' => [
        'Whoops',
    ],
    'module_listener_options' => [
        'module_paths' => [
            'Whoops' => './vendor/filp/whoops/src/Whoops/Provider/Zend',
        ],
    ],
];
