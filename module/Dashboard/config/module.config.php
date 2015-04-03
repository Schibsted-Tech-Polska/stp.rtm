<?php
namespace Dashboard;

return array(
    'router' => array(
        'routes' => array(
            'dashboard' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/:configName',
                    'constraints' => array(
                        'configName' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Dashboard\Controller\Dashboard',
                        'action' => 'dashboard',
                    ),
                ),
            ),
            'addEvent' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/event/:configName/:widgetId',
                    'constraints' => array(
                        'configName' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'widgetId' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Dashboard\Controller\EventsApiController',
                    ),
                ),
            ),
            'lpServer' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/resources/:configName/:id[/:oldHash]',
                    'constraints' => array(
                        'configName' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Dashboard\Controller\LongPollingController',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Dashboard\Controller\Dashboard' => 'Dashboard\Controller\DashboardController',
            'Dashboard\Controller\LongPollingController' => 'Dashboard\Controller\LongPollingController',
            'Dashboard\Controller\EventsApiController' => 'Dashboard\Controller\EventsApiController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'dashboard' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'createBootstrapRows' => 'Dashboard\View\Helper\BootstrapRowHelper',
        )
    ),
    'dashboardCache' => array(
        'ttl' => 604800, // 7 days = 3600 * 24 * 7
        'namespace' => 'rtm_dashboard_' . filemtime(__FILE__),
        'key_pattern' => null,
        'readable' => true,
        'writable' => true,
        'servers' => 'localhost',
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver',

                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Document')
            ),
            'odm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Document' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),
);
