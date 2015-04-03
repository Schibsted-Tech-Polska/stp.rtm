<?php
/**
 * Config for rtm
 */
return array(
    'theme' => 'dark', // (optional) default 'dark'
    'newRelic' => array(
        'headers' => array(
            'x-api-key' => '0116c7512e1efa28a39116312e9640edb90f1f52bb6ab30',
        ),
        'params' => array(
            'accountId' => '100366',
        ),
    ),
    'gearman' => array(
        'params' => array(
            'gearmanuiUrl' => 'https://red.vgnett.no/godt-gearmanui/web',
        ),
        'headers' => array(
            'X-Requested-With' => 'XMLHttpRequest',
        ),
        'auth' => array(
            'username' => 'wiskra',
            'password' => 'DopdeDey',
        ),
    ),
    'slack' => array(
        'params' => array(
            'token' => 'xoxp-3176818426-4103564791-4117485223-5606c6',
        ),
    ),
    'splunk' => array(
        'params' => array(
            'baseUrl' => 'https://mother.int.vgnett.no:8089',
        ),
        'auth' => array(
            'username' => 'wiskra',
            'password' => 'DopdeDey',
        ),
    ),
    'jenkins' => array(
        'params' => array(
            'baseUrl' => 'http://ci.vgnett.no/',
        ),
    ),
    'widgets' => array(
        array('id' => 'messagesSlack',
            'type' => 'slack',
            'params' => array(
                'dao' => 'slack',
                'metric' => 'listRecentMessages',
                'span' => 6,
                'subtitle' => '',
                'title' => 'VK Slack',
                'channel' => 'C044Q8M5W',
                'count' => 8,
            ),
        ),
        array('id' => 'vgFoodSplunk500',
            'type' => 'alert',
            'params' => array(
                'dao' => 'splunk',
                'metric' => 'Fivehundreds',
                'title' => 'Godt.no',
                'subtitle' => '500 errors in last 24h',
                'config' => [
                    'search' => 'search sourcetype=apache_access NOT(toolbox) host=godt-web-* OR host=red-web-* status=500 | stats count latest(_time) as latestTime by url | sort -count | head 5',
                    'earliest_time' => '-1h',
                    'latest' => 'now',
                    'output_mode' => 'json_cols',
                ],
                'span' => 6,
            ),
        ),

        array('id' => 'foodCpuUsageGraph',
            'type' => 'number',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'cpuUsage',
                'appId' => '1716240',
                'title' => 'CPU usage',
                'valueSuffix' => '%',
                'span' => 3,
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now',
            ),
        ),
        array('id' => 'foodMemory',
            'type' => 'number',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'memory',
                'appId' => '1716240',
                'title' => 'Memory',
                'valueSuffix' => 'MB',
            ),
        ),
        array('id' => 'gearman',
            'type' => 'gearman',
            'params' => array(
                'dao' => 'gearman',
                'metric' => 'jobsWithWorkers',
                'title' => 'Gearman queue',
                'span' => 6,
            ),
        ),

        array('id' => 'foodAverageResponseTimeGraph',
            'type' => 'number',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'averageResponseTime',
                'appId' => '1716240',
                'title' => 'Average response time',
                'span' => 6,
                'valueSuffix' => 'ms',
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now',
            ),
        ),
        array('id' => 'GodtBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'GodtProject',
                'job' => 'godt-web',
                'metric' => 'status',
                'title' => 'Godt Build',
            ),
        ),
        array('id' => 'vgFoodAdminBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'GodtProject',
                'job' => 'VG_food-admin',
                'metric' => 'status',
                'title' => 'Admin Build',
            ),
        ),

        array('id' => 'foodFeRpm',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'feRpm',
                'appId' => '1716240',
                'span' => 3,
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now',
                'title' => 'Frontend RPM',
                'thresholdComparator' => 'higherIsBetter',
            ),
        ),
        array('id' => 'foodBeRpm',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'rpm',
                'appId' => '1716240',
                'span' => 3,
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now',
                'title' => 'Backend RPM',
                'thresholdComparator' => 'higherIsBetter',
            ),
        ),
        array('id' => 'GodtPediffBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'GodtProject',
                'job' => 'godt-pediff',
                'metric' => 'status',
                'title' => 'Pediff Build',
            ),
        ),


        array('id' => 'vgFoodPackagesBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'GodtProject',
                'job' => 'VG_food-packages',
                'metric' => 'status',
                'title' => 'Packages Build',
            ),
        ),

        array('id' => 'foodErrorRate',
            'type' => 'error',
            'params' => array(
                'dao' => 'newRelic',
                'valueSuffix' => '%',
                'metric' => 'errorRate',
                'appId' => '1716240',
                'title' => 'Error Rate',
            ),
        ),
        array('id' => 'godtApdex',
            'type' => 'number',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'apdex',
                'appId' => '1716240',
                'title' => 'apdex',
                'thresholdComparator' => 'higherIsBetter',
            ),
        ),
        array('id' => 'GodtQunitBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'GodtProject',
                'job' => 'godt-web-qunit',
                'metric' => 'status',
                'title' => 'Qunit Build',
            ),
        ),
        array('id' => 'vgFoodLibraryBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'GodtProject',
                'job' => 'VG_food-library',
                'metric' => 'status',
                'title' => 'Library Build',
            ),
        ),



    ),
);
