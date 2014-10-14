<?php
/**
 * This is a sample single-job Jenkins dashboard.
 * It consists of a single widget for a single build.
 *
 * All you have to do is replace variables surronded with '%' char with your data.
 */
return array(
    'jenkins' => array(
        'params' => array(
            'baseUrl' => 'http://%JENKINS_USER%:%JENKINS_PASSWORD%@%JENKINS_HOST%'
        )
    ),
    'widgets' => array(
        array('id' => '%WIDGET_ID%',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'job' => '%JENKINS_JOB_NAME%',
                'metric' => 'status',
                'title' => 'Sample project build',
            ),
        ),
    ),
);
