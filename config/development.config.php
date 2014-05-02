<?php
ini_set('display_errors', 1);
ini_set('log_errors', 0);

return array(
    'modules' => array(
        'Whoops',
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            'Whoops' => './vendor/filp/whoops/src/Whoops/Provider/Zend',
        ),
    ),
);
