<?php
namespace Dashboard;

return [
    'router' => [
        'routes' => [
            'dashboard' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/:configName',
                    'constraints' => [
                        'configName' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => 'Dashboard\Controller\Dashboard',
                        'action' => 'dashboard',
                    ],
                ],
            ],
            'addEvent' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/api/event/:configName/:widgetId',
                    'constraints' => [
                        'configName' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'widgetId' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => 'Dashboard\Controller\EventsApiController',
                    ],
                ],
            ],
            'lpServer' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/resources/:configName/:id[/:oldHash]',
                    'constraints' => [
                        'configName' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => 'Dashboard\Controller\LongPollingController',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            'Dashboard\Controller\Dashboard' => 'Dashboard\Controller\DashboardController',
            'Dashboard\Controller\LongPollingController' => 'Dashboard\Controller\LongPollingController',
            'Dashboard\Controller\EventsApiController' => 'Dashboard\Controller\EventsApiController',
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'dashboard' => __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'createBootstrapRows' => 'Dashboard\View\Helper\BootstrapRowHelper',
        ],
    ],
    'dashboardCache' => [
        'ttl' => 604800, // 7 days = 3600 * 24 * 7
        'namespace' => 'rtm_dashboard_' . filemtime(__FILE__),
        'key_pattern' => null,
        'readable' => true,
        'writable' => true,
        'servers' => 'localhost',
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => 'Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver',

                'paths' => [__DIR__ . '/../src/' . __NAMESPACE__ . '/Document'],
            ],
            'odm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Document' => __NAMESPACE__ . '_driver',
                ],
            ],
        ],
    ],
];
