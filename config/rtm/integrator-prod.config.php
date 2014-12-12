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
            'serverId' => '5499705',
        ),
    ),
    'rabbitMQ' => array(
        'params' => array(
            'rabbitMQUrl' => 'http://vg-rabbit-01:15672',
            'vhost' => 'integrator',
        ),
        'headers' => array(
            'X-Requested-With' => 'XMLHttpRequest',
        ),
        'auth' => array(
            'username' => 'integrator',
            'password' => 'AEQVG5Pk',
        ),
    ),
    'hipChat' => array(
        'params' => array(
            'auth_token' => 'd5e182ac9d356cbc72b9f9c2fc119f',
        ),
    ),
    'eye' => array(
        'params' => array(
            'eyeUrl' => 'http://vg-integrator-01.int.vgnett.no:6937',
        ),
    ),
    'jenkins' => array(
        'params' => array(
            'baseUrl' => 'http://ci.vgnett.no/',
        ),
    ),
    'hadoop' => array(
        'params' => array(
            'baseUrl' => 'http://vg-hadoop-01:50070',
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
        array('id' => 'xitiCrawler1',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'XITI 1',
                'subtitle' => 'crawler',
                'processName' => 'xiti_dpplus-browser_dpplus-mobile',
                'span' => 1,
            ),
        ),
        array('id' => 'xitiCrawler2',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'XITI 2',
                'subtitle' => 'crawler',
                'processName' => 'xiti_godt-browser_minmote',
                'span' => 1,
            ),
        ),
        array('id' => 'xitiCrawler3',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'XITI 3',
                'subtitle' => 'crawler',
                'processName' => 'xiti_vektklubb-browser_vektklubb-mobile',
                'span' => 1,
            ),
        ),
        array('id' => 'xitiCrawler4',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'XITI 4',
                'subtitle' => 'crawler',
                'processName' => 'xiti_vgpluss-app-query_vgpluss-browser-query',
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
        array('id' => 'manipulationStructureMappingProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'Structure map',
                'subtitle' => 'manipulator',
                'processName' => 'manipulation-structuremapping_integrator_manipulation_structuremapping_queue_integrator_after-manipulation_exchange',
                'span' => 1,
            ),
        ),
        array('id' => 'manipulationSpidUserAccountsProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'SPiD useraccounts',
                'subtitle' => 'manipulator',
                'processName' => 'manipulation-spid-useraccounts_integrator_manipulation_spid_useraccounts_queue_integrator_after-manipulation_exchange',
                'span' => 1,
            ),
        ),

        // CLEANERS
        array('id' => 'cleaningSpidUsersProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'SPiD users',
                'subtitle' => 'cleaner',
                'processName' => 'cleaning-spidusers',
                'span' => 1,
            ),
        ),

        // WRITERS
        array('id' => 'rawHadoopWriterProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'RAW Hadoop',
                'subtitle' => 'writer',
                'processName' => 'destination-hdd_integrator_raw_hadoop',
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
                'processName' => 'destination-hdd_integrator_clean_hadoop',
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
                'processName' => 'destination-mysql_integrator_clean_mysql',
                'span' => 1,
            ),
        ),

        // ADOBE CAMPAIGN
        array('id' => 'acExportClientConnectionsProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'AC client connection',
                'subtitle' => 'export',
                'processName' => 'adobecampaign_client-connections',
                'span' => 1,
            ),
        ),
        array('id' => 'acExportCustomerProductsProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'AC customer product',
                'subtitle' => 'export',
                'processName' => 'adobecampaign_customer-products',
                'span' => 1,
            ),
        ),
        array('id' => 'acExportCustomersProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'AC customers',
                'subtitle' => 'export',
                'processName' => 'adobecampaign_customers',
                'span' => 1,
            ),
        ),
        array('id' => 'acExportProductsProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'AC products',
                'subtitle' => 'export',
                'processName' => 'adobecampaign_products',
                'span' => 1,
            ),
        ),
        array('id' => 'acExportProductsProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'AC vektklubb',
                'subtitle' => 'export',
                'processName' => 'adobecampaign_vektklubb',
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
        array('id' => 'integratorStructureMappingMessages',
            'type' => 'graph',
            'params' => array(
                'dao' => 'rabbitMQ',
                'metric' => 'queuedMessages',
                'title' => 'Structure map',
                'subtitle' => 'manipulation',
                'span' => 1,
                'queueName' => 'integrator:manipulation:structuremapping:queue',
                'secondsBack' => '1200',
                'secondsIntervals' => '5',
                'refreshRate' => 5,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 1000000,
                'critical-value' => 5000000,
            ),
        ),
        array('id' => 'integratorSpidUserAccountsManipulatorMessages',
            'type' => 'graph',
            'params' => array(
                'dao' => 'rabbitMQ',
                'metric' => 'queuedMessages',
                'title' => 'SPiD useraccounts',
                'subtitle' => 'manipulation',
                'span' => 1,
                'queueName' => 'integrator:manipulation:spid:useraccounts:queue',
                'secondsBack' => '1200',
                'secondsIntervals' => '5',
                'refreshRate' => 5,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 1000000,
                'critical-value' => 5000000,
            ),
        ),
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
//        array('id' => 'integratorCleanHadoopMessages',
//            'type' => 'graph',
//            'params' => array(
//                'dao' => 'rabbitMQ',
//                'metric' => 'queuedMessages',
//                'title' => 'Hadoop CLEAN',
//                'span' => 1,
//                'queueName' => 'integrator:clean:hadoop:queue',
//                'secondsBack' => '1200',
//                'secondsIntervals' => '5',
//                'refreshRate' => 5,
//                'thresholdComparator' => 'lowerIsBetter',
//                'caution-value' => 1000000,
//                'critical-value' => 5000000,
//            ),
//        ),
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
                'queueName' => 'integrator:clean:mysql:newData:queue',
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
                'nodeName' => 'rabbit@vg-rabbit-01',
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 10737418240,
                'critical-value' => 15 * 1073741824,
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
                'nodeName' => 'rabbit@vg-rabbit-01',
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
                'caution-value' => 10737418240,
                'critical-value' => 15 * 1073741824,
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
                'span' => 3,
                'ignoreQueues' => ['.*testing.*', '.*:invalid:.*', '.*:not-existing:.*'],
                'queueNameParser' => function($queueName) { return str_replace(':queue', '', str_replace('integrator:', '', $queueName));},
            ),
        ),
    ),
);
