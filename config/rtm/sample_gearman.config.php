<?php
/**
 * Config for rtm
 */
return [
    'gearman' => [
        'params' => [
            'gearmanuiUrl' => 'http://wiskra.vgnett.no/gearmanui',
        ],
    ],
    'widgets' => [
        ['id' => 'gearman',
            'type' => 'queue',
            'params' => [
                'dao' => 'gearman',
                'metric' => 'jobsWithWorkers',
                'title' => 'Gearman queue',
                'span' => 6,
            ],
        ],
    ],
];
