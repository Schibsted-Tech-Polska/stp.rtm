<?php
/**
 * Config for rtm
 */
return array(
    'gearman' => array(
        'params' => array(
            'gearmanuiUrl' => 'http://wiskra.vgnett.no/gearmanui',
        ),
    ),
    'widgets' => array(
        array('id' => 'gearman',
            'type' => 'queue',
            'params' => array(
                'dao' => 'gearman',
                'metric' => 'jobsWithWorkers',
                'title' => 'Gearman queue',
                'span' => 6,
            ),
        ),
    ),
);
