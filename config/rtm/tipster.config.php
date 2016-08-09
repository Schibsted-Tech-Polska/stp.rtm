<?php
/**
 * Config for rtm
 */
return array(
    'theme' => ['tv', 'dark'],
    'newRelic' => array(
        'headers' => array(
            'x-api-key' => '0116c7512e1efa28a39116312e9640edb90f1f52bb6ab30',
        ),
        'params' => array(
            'accountId' => '100366',
        ),
    ),
    'slack' => array(
        'params' => array(
            'token' => 'xoxp-3176818426-4103564791-4117485223-5606c6',
        ),
    ),
    'splunk' => array(
        'params' => array(
            'baseUrl' => 'https://splunk-01.int.vgnett.no:8089',
        ),
        'auth' => array(
            'username' => 'stprtm',
            'password' => 'VTNAj7s8WErvR9uYhZeA',
        ),
    ),
    'jenkins' => array(
        'params' => array(
            'baseUrl' => 'http://ci.vgnett.no/',
        ),
    ),
    'widgets' => array(
        array('id' => 'tipsterWebSplunk500',
            'type' => 'alert',
            'params' => array(
                'dao' => 'splunk',
                'metric' => 'Fivehundreds',
                'title' => 'Tipster WEB',
                'subtitle' => '500 errors in last 24h',
                'config' => [
                    'search' => 'search sourcetype=docker app=/tipster/web-production status_code>=500 | stats count latest(_time) as latestTime by URL | sort -count | head 5',
                    'earliest_time' => '-1h',
                    'latest' => 'now',
                    'output_mode' => 'json',
                    'exec_mode' => 'oneshot',
                ],
                'span' => 3,
            ),
        ),
        array('id' => 'tipsterWebMemory',
            'type' => 'incrementalGraph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'memory',
                'appId' => '23039171',
                'title' => 'Memory',
                'valueSuffix' => 'MB',
                'span' => 3,
                'refreshRate' => 10,
            ),
        ),
        array('id' => 'tipsterWebBeRpm',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'rpm',
                'appId' => '23039171',
                'span' => 3,
                'beginDateTime' => '-60 minutes',
                'endDateTime' => 'now',
                'title' => 'Backend RPM',
                'thresholdComparator' => 'higherIsBetter',
            ),
        ),
        array('id' => 'tipsterWebAverageResponseTimeGraph',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'averageResponseTime',
                'appId' => '23039171',
                'title' => 'Average response time',
                'span' => 3,
                'valueSuffix' => 'ms',
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now',
                'useThreshold' => 1,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 200,
                'critical-value' => 300,
            ),
        ),



        array('id' => 'tipsterWebErrorRate',
            'type' => 'error',
            'params' => array(
                'dao' => 'newRelic',
                'valueSuffix' => '%',
                'metric' => 'errorRate',
                'appId' => '23039171',
                'title' => 'Error Rate',
                'span' => 1,
                'useThreshold' => 1,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 2.5,
                'critical-value' => 5,
            ),
        ),
        array('id' => 'godtApdex',
            'type' => 'number',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'apdex',
                'appId' => '23039171',
                'title' => 'apdex',
                'span' => 1,
                'thresholdComparator' => 'higherIsBetter',
            ),
        ),
        array('id' => 'TipsterWebPRBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Tipster',
                'job' => 'tipster-web.build-pr',
                'metric' => 'status',
                'title' => 'Tipster WEB PR',
                'span' => 1,
            ),
        ),
        array('id' => 'TipsterWebBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Tipster',
                'job' => 'tipster-web.deploy.docker-build',
                'metric' => 'status',
                'title' => 'Tipster WEB',
                'subtitle' => 'Docker build',
                'span' => 1,
            ),
        ),
        array('id' => 'TipsterWebBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Tipster',
                'job' => 'tipster-web.deploy.docker-publish',
                'metric' => 'status',
                'title' => 'Tipster WEB',
                'subtitle' => 'Docker publish',
                'span' => 1,
            ),
        ),
        array('id' => 'TipsterWebStagingDeployStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Tipster',
                'job' => 'tipster-web.deploy.staging-deploy',
                'metric' => 'status',
                'title' => 'Tipster WEB',
                'subtitle' => 'staging deploy',
                'span' => 1,
            ),
        ),
        array('id' => 'TipsterWebTestprodDeployStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Tipster',
                'job' => 'tipster-web.deploy.testprod-deploy',
                'metric' => 'status',
                'title' => 'Tipster WEB',
                'subtitle' => 'testprod deploy',
                'span' => 1,
            ),
        ),
        array('id' => 'TipsterWebRediffBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Tipster',
                'job' => 'tipster-web.rediff',
                'metric' => 'status',
                'title' => 'Tipster WEB',
                'subtitle' => 'rediff',
                'span' => 1,
            ),
        ),
        array('id' => 'TipsterWebProductionDeployStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Tipster',
                'job' => 'tipster-web.deploy.production-deploy',
                'metric' => 'status',
                'title' => 'Tipster WEB',
                'subtitle' => 'production deploy',
                'span' => 1,
            ),
        ),

        /**
         * TIPSTER ADMIN
         */
        array('id' => 'TipsterAdminPRBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Tipster',
                'job' => 'tipster.admin-pr',
                'metric' => 'status',
                'title' => 'Tipster ADMIN PR',
                'span' => 2,
            ),
        ),
        array('id' => 'TipsterAdminBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Tipster',
                'job' => 'tipster.admin',
                'metric' => 'status',
                'title' => 'Tipster ADMIN',
                'span' => 2,
            ),
        ),

        /**
         * TIPSTER API
         */
        array('id' => 'tipsterApiSplunk500',
            'type' => 'alert',
            'params' => array(
                'dao' => 'splunk',
                'metric' => 'Fivehundreds',
                'title' => 'Tipster API',
                'subtitle' => '500 errors in last 24h',
                'config' => [
                    'search' => 'search sourcetype=docker app=/tipster/api-production status_code>=500 | stats count latest(_time) as latestTime by URL | sort -count | head 5',
                    'earliest_time' => '-1h',
                    'latest' => 'now',
                    'output_mode' => 'json',
                    'exec_mode' => 'oneshot',
                ],
                'span' => 3,
            ),
        ),
        array('id' => 'tipsterApiMemory',
            'type' => 'incrementalGraph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'memory',
                'appId' => '23040254',
                'title' => 'Memory',
                'valueSuffix' => 'MB',
                'span' => 3,
                'refreshRate' => 10,
            ),
        ),
        array('id' => 'tipsterApiBeRpm',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'rpm',
                'appId' => '23040254',
                'span' => 3,
                'beginDateTime' => '-60 minutes',
                'endDateTime' => 'now',
                'title' => 'Backend RPM',
                'thresholdComparator' => 'higherIsBetter',
            ),
        ),
        array('id' => 'tipsterApiAverageResponseTimeGraph',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'averageResponseTime',
                'appId' => '23040254',
                'title' => 'Average response time',
                'span' => 3,
                'valueSuffix' => 'ms',
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now',
                'useThreshold' => 1,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 200,
                'critical-value' => 300,
            ),
        ),


        array('id' => 'TipsterApiPRBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Tipster',
                'job' => 'tipster-api.build-pr',
                'metric' => 'status',
                'title' => 'Tipster API PR',
                'span' => 2,
            ),
        ),
        array('id' => 'TipsterApiBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Tipster',
                'job' => 'tipster-api.deploy.docker-build',
                'metric' => 'status',
                'title' => 'Tipster API',
                'subtitle' => 'Docker build',
                'span' => 2,
            ),
        ),
        array('id' => 'TipsterApiBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Tipster',
                'job' => 'tipster-api.deploy.docker-publish',
                'metric' => 'status',
                'title' => 'Tipster API',
                'subtitle' => 'Docker publish',
                'span' => 2,
            ),
        ),
        array('id' => 'TipsterApiStagingDeployStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Tipster',
                'job' => 'tipster-api.deploy.staging-deploy',
                'metric' => 'status',
                'title' => 'Tipster API',
                'subtitle' => 'staging deploy',
                'span' => 2,
            ),
        ),
        array('id' => 'TipsterApiProductionDeployStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'Tipster',
                'job' => 'tipster-api.deploy.production-deploy',
                'metric' => 'status',
                'title' => 'Tipster API',
                'subtitle' => 'production deploy',
                'span' => 2,
            ),
        ),

    ),
);
