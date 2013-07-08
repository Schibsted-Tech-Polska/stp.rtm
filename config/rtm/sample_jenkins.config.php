<?php
/**
 * This is a sample single-job Jenkins dashboard.
 * It consists of a single widget for a single build.
 * All you have to do is replace %JENKINS_JOB_NAME% with your unique Jenkins job name.
 */
return array(
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
