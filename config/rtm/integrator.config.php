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
            'serverId' => '5482818',
        ),
    ),
    'rabbitMQ' => array(
        'params' => array(
            'rabbitMQUrl' => 'http://vg-rabbit-s01:15672',
            'vhost' => 'integrator',
        ),
        'headers' => array(
            'X-Requested-With' => 'XMLHttpRequest',
        ),
        'auth' => array(
            'username' => 'integrator',
            'password' => 'QO;A=h}[',
        ),
    ),
    'hipChat' => array(
        'params' => array(
            'auth_token' => 'd5e182ac9d356cbc72b9f9c2fc119f',
        ),
    ),
    'eye' => array(
        'params' => array(
            'eyeUrl' => 'http://vg-integrator-s01.int.vgnett.no:6937',
        ),
    ),
    'jenkins' => array(
        'params' => array(
            'baseUrl' => 'http://ci.vgnett.no/',
        ),
    ),
    'hadoop' => array(
        'params' => array(
            'baseUrl' => 'http://vg-hadoop-s01:50070',
        ),
    ),
    'widgets' => array(
        // EYE PROCESSES
//        array('id' => 'integratorEyeProcesses',
//            'type' => 'eye',
//            'params' => array(
//                'dao' => 'eye',
//                'metric' => 'info',
//                'title' => 'Eye processes',
//                'span' => 3,
//            ),
//        ),

        // EYE CRAWLERS
        array('id' => 'xitiDPPlusBrowserCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'DP+ browser',
                'subtitle' => 'crawler',
                'processName' => 'xiti_dpplus-browser',
                'span' => 1,
            ),
        ),
        array('id' => 'xitiDPPlusMobileCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'DP+ mobile',
                'subtitle' => 'crawler',
                'processName' => 'xiti_dpplus-mobile',
                'span' => 1,
            ),
        ),
        array('id' => 'xitiGodtBrowserCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'Godt browser',
                'subtitle' => 'crawler',
                'processName' => 'xiti_godt-browser',
                'span' => 1,
            ),
        ),
        array('id' => 'xitiMinmoteCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'Minmote',
                'subtitle' => 'crawler',
                'processName' => 'xiti_minmote',
                'span' => 1,
            ),
        ),
        array('id' => 'xitiVektklubbBrowserCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'Vektklubb browser',
                'subtitle' => 'crawler',
                'processName' => 'xiti_vektklubb-browser',
                'span' => 1,
            ),
        ),
        array('id' => 'xitiVektklubbMobileCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'Vektklubb mobile',
                'subtitle' => 'crawler',
                'processName' => 'xiti_vektklubb-mobile',
                'span' => 1,
            ),
        ),
        array('id' => 'xitiVgAppQueryCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'XITI VG+ app',
                'subtitle' => 'crawler',
                'processName' => 'xiti_vgpluss-app-query',
                'span' => 1,
            ),
        ),
        array('id' => 'xitiVgBrowserQueryCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'XITI VG+ browser',
                'subtitle' => 'crawler',
                'processName' => 'xiti_vgpluss-browser-query',
                'span' => 1,
            ),
        ),
        array('id' => 'spidOrdersCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'SPiD orders',
                'subtitle' => 'crawler',
                'processName' => 'spid_orders',
                'span' => 1,
            ),
        ),
        array('id' => 'spidProductsCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'SPiD products',
                'subtitle' => 'crawler',
                'processName' => 'spid_products',
                'span' => 1,
            ),
        ),
        array('id' => 'spidLoginsCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'SPiD logins',
                'subtitle' => 'crawler',
                'processName' => 'spid_logins',
                'span' => 1,
            ),
        ),
        array('id' => 'spidSubscriptionsCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'SPiD subscriptions',
                'subtitle' => 'crawler',
                'processName' => 'spid_subscriptions',
                'span' => 1,
            ),
        ),
        array('id' => 'spidCampaignsCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'SPiD campaigns',
                'subtitle' => 'crawler',
                'processName' => 'spid_campaigns',
                'span' => 1,
            ),
        ),
        array('id' => 'spidUsersCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'SPiD users',
                'subtitle' => 'crawler',
                'processName' => 'spid_users',
                'span' => 1,
            ),
        ),
        array('id' => 'vektklubbUsersCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'Vektklubb',
                'subtitle' => 'crawler',
                'processName' => 'vektklubb_users',
                'span' => 1,
            ),
        ),
        array('id' => 'newsletterSubscriptionsCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'Subscriptions',
                'subtitle' => 'crawler',
                'processName' => 'newsletter-subscriptions_subscriptions',
                'span' => 1,
            ),
        ),

        // MANIPULATORS
        array('id' => 'manipulationSpidProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'SPiD manipulation',
                'processName' => 'manipulation-spid',
                'span' => 1,
            ),
        ),
        // CLEANERS
        // none for now...

        // WRITERS
        array('id' => 'rawHadoopWriterProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'RAW Hadoop',
                'subtitle' => 'writer',
                'processName' => 'destination-raw-hadoop',
                'span' => 1,
            ),
        ),
        array('id' => 'cleanHadoopWriterProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'CLEAN Hadoop',
                'subtitle' => 'writer',
                'processName' => 'destination-clean-hadoop',
                'span' => 1,
            ),
        ),
        array('id' => 'cleanMysqlWriterProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'MySQL',
                'subtitle' => 'writer',
                'processName' => 'destination-clean-mysql',
                'span' => 1,
            ),
        ),

        // OTHER SCRIPTS
        array('id' => 'rawHadoopPutProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'RAW Hadoop PUT',
                'subtitle' => 'script',
                'processName' => 'raw',
                'span' => 1,
            ),
        ),
        array('id' => 'cleanHadoopPutProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'CLEAN Hadoop PUT',
                'subtitle' => 'script',
                'processName' => 'raw',
                'span' => 1,
            ),
        ),

        // QUEUES
        array('id' => 'integratorRawHadoopMessages',
            'type' => 'graph',
            'params' => array(
                'dao' => 'rabbitMQ',
                'metric' => 'queuedMessages',
                'title' => 'Hadoop RAW',
                'span' => 1,
                'queueName' => 'integrator:raw:hadoop:queue',
                'secondsBack' => '1200',
                'secondsIntervals' => '5',
                'refreshRate' => 5,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 1000000,
                'critical-value' => 5000000,
            ),
        ),
        array('id' => 'integratorRawHadoopInvalidMessages',
            'type' => 'graph',
            'params' => array(
                'dao' => 'rabbitMQ',
                'metric' => 'queuedMessages',
                'title' => 'RAW',
                'subtitle' => 'invalid',
                'span' => 1,
                'queueName' => 'integrator:raw:hadoop:invalid:queue',
                'secondsBack' => '1200',
                'secondsIntervals' => '5',
                'refreshRate' => 5,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 1000000,
                'critical-value' => 5000000,
            ),
        ),
        array('id' => 'integratorCleanHadoopMessages',
            'type' => 'graph',
            'params' => array(
                'dao' => 'rabbitMQ',
                'metric' => 'queuedMessages',
                'title' => 'Hadoop CLEAN',
                'span' => 1,
                'queueName' => 'integrator:clean:hadoop:queue',
                'secondsBack' => '1200',
                'secondsIntervals' => '5',
                'refreshRate' => 5,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 1000000,
                'critical-value' => 5000000,
            ),
        ),
        array('id' => 'integratorCleanHadoopInvalidMessages',
            'type' => 'graph',
            'params' => array(
                'dao' => 'rabbitMQ',
                'metric' => 'queuedMessages',
                'title' => 'CLEAN',
                'subtitle' => 'invalid',
                'span' => 1,
                'queueName' => 'integrator:clean:hadoop:invalid:queue',
                'secondsBack' => '1200',
                'secondsIntervals' => '5',
                'refreshRate' => 5,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 1000000,
                'critical-value' => 5000000,
            ),
        ),
        array('id' => 'integratorCleanMysqlMessages',
            'type' => 'graph',
            'params' => array(
                'dao' => 'rabbitMQ',
                'metric' => 'queuedMessages',
                'title' => 'MySQL',
                'span' => 1,
                'queueName' => 'integrator:clean:mysql:queue',
                'secondsBack' => '1200',
                'secondsIntervals' => '5',
                'refreshRate' => 5,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 1000000,
                'critical-value' => 5000000,
            ),
        ),
        array('id' => 'integratorCleanMysqlInvalidMessages',
            'type' => 'graph',
            'params' => array(
                'dao' => 'rabbitMQ',
                'metric' => 'queuedMessages',
                'title' => 'MySQL',
                'subtitle' => 'invalid',
                'span' => 1,
                'queueName' => 'integrator:clean:mysql:invalid:queue',
                'secondsBack' => '1200',
                'secondsIntervals' => '5',
                'refreshRate' => 5,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 1000000,
                'critical-value' => 5000000,
            ),
        ),

        array('id' => 'integratorRabbitMemory',
            'type' => 'usage',
            'params' => array(
                'dao' => 'rabbitMQ',
                'metric' => 'nodeMemoryUsage',
                'title' => 'RabbitMQ',
                'subtitle' => 'memory usage',
                'span' => 1,
                'nodeName' => 'rabbit@vg-rabbit-s01',
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 536870912,
                'critical-value' => 891289600,
                'numericSystem' => 'binary',
            ),
        ),
        array('id' => 'integratorRabbitDiskUsage',
            'type' => 'usage',
            'params' => array(
                'dao' => 'rabbitMQ',
                'metric' => 'nodeDiskUsage',
                'title' => 'RabbitMQ',
                'subtitle' => 'disk usage',
                'span' => 1,
                'nodeName' => 'rabbit@vg-rabbit-s01',
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 50,
                'critical-value' => 75,
                'valueSuffix' => '%'
            ),
        ),
        array('id' => 'integratorApplicationCpuUsage',
            'type' => 'graph',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'serverCpuUsage',
                'title' => 'Application',
                'subtitle' => 'CPU usage',
                'valueSuffix' => '%',
                'span' => 1,
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now',
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 50,
                'critical-value' => 75,
            ),
        ),
        array('id' => 'integratorApplicationDiskUsage',
            'type' => 'usage',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'diskUsage',
                'title' => 'Application',
                'subtitle' => 'disk usage',
                'span' => 1,
                'beginDateTime' => '-2 minutes',
                'endDateTime' => 'now',
                'diskName' => '^',
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 5 * 1073741824,
                'critical-value' => 10 * 1073741824,
                'numericSystem' => 'binary',
            ),
        ),
        array('id' => 'integratorApplicationMemoryUsage',
            'type' => 'usage',
            'params' => array(
                'dao' => 'newRelic',
                'metric' => 'memoryUsage',
                'title' => 'Application',
                'subtitle' => 'memory usage',
                'span' => 1,
                'beginDateTime' => '-2 minutes',
                'endDateTime' => 'now',
                'diskName' => '^',
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 1073741824,
                'critical-value' => 1.5 * 1073741824,
                'numericSystem' => 'binary',
            ),
        ),
        array('id' => 'hadoopDiskUsage',
            'type' => 'usage',
            'params' => array(
                'dao' => 'hadoop',
                'metric' => 'diskUsage',
                'title' => 'Hadoop',
                'subtitle' => 'disk usage',
                'span' => 1,
                'thresholdComparator' => 'higherIsBetter',
                'caution-value' => 1073741824,
                'critical-value' => 1073741824/2,
                'numericSystem' => 'binary',
                'refreshRate' => 3600
            ),
        ),
        array('id' => 'integratorRabbitMQQueues',
            'type' => 'rabbitMQ',
            'params' => array(
                'dao' => 'rabbitMQ',
                'metric' => 'queues',
                'title' => 'RabbitMQ',
                'span' => 4,
                'ignoreQueues' => ['.*testing.*', '.*:invalid:.*', '.*:not-existing:.*'],
                'queueNameParser' => function($queueName) { return str_replace(':queue', '', str_replace('integrator:', '', $queueName));},
            ),
        ),
    ),
);
