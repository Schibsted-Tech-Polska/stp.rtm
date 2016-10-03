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
    'jenkins' => array(
        'params' => array(
            'baseUrl' => 'http://ci.vgnett.no/',
        ),
    ),
    'hadoop' => array(
        'params' => array(
            'baseUrl' => 'http://hdp-01:50070',
        ),
    ),
    'supervisord' => [
        'params' => [
            'baseUrl' => 'http://vg-integrator-01:9001/RPC2',
        ],
    ],
    'widgets' => array(
        // CRAWLERS
        array('id' => 'xitiVgMobile',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'XITI VG mobile',
                'subtitle' => 'crawler',
                'processName' => 'crawlers-xiti_vg-mobile',
                'span' => 1,
            ),
        ),
        array('id' => 'xitiVgTablet',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'XITI VG tablet',
                'subtitle' => 'crawler',
                'processName' => 'crawlers-xiti_vg-tablet',
                'span' => 1,
            ),
        ),
        array('id' => 'xitiVgDesktop',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'XITI VG desktop',
                'subtitle' => 'crawler',
                'processName' => 'crawlers-xiti_vg-desktop',
                'span' => 1,
            ),
        ),
        array('id' => 'xitiCrawler1',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'XITI 1',
                'subtitle' => 'crawler',
                'processName' => 'crawlers-xiti_dpplus-browser_dpplus-mobile_vgpluss-browser-query',
                'span' => 1,
            ),
        ),
        array('id' => 'xitiCrawler2',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'XITI 2',
                'subtitle' => 'crawler',
                'processName' => 'crawlers-xiti_godt-browser_minmote-vektklubb-mobile',
                'span' => 1,
            ),
        ),
        array('id' => 'xitiCrawler3',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'XITI 3',
                'subtitle' => 'crawler',
                'processName' => 'crawlers-xiti_vektklubb-browser',
                'span' => 1,
            ),
        ),
        array('id' => 'xitiCrawler4',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'XITI 4',
                'subtitle' => 'crawler',
                'processName' => 'crawlers-xiti_vgpluss-app-query',
                'span' => 1,
            ),
        ),
        array('id' => 'spidOrdersCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'SPiD orders',
                'subtitle' => 'crawler',
                'processName' => 'crawlers-spid_orders',
                'span' => 1,
            ),
        ),
        array('id' => 'spidProductsCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'SPiD products',
                'subtitle' => 'crawler',
                'processName' => 'crawlers-spid_products',
                'span' => 1,
            ),
        ),
        array('id' => 'spidLoginsCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'SPiD logins',
                'subtitle' => 'crawler',
                'processName' => 'crawlers-spid_logins',
                'span' => 1,
            ),
        ),
        array('id' => 'spidSubscriptionsCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'SPiD subscriptions',
                'subtitle' => 'crawler',
                'processName' => 'crawlers-spid_subscriptions',
                'span' => 1,
            ),
        ),
        array('id' => 'spidCampaignsCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'SPiD campaigns',
                'subtitle' => 'crawler',
                'processName' => 'crawlers-spid_campaigns',
                'span' => 1,
            ),
        ),
        array('id' => 'spidUsersCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'SPiD users',
                'subtitle' => 'crawler',
                'processName' => 'crawlers-spid_users',
                'span' => 1,
            ),
        ),
        array('id' => 'vektklubbUsersCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'Vektklubb',
                'subtitle' => 'crawler',
                'processName' => 'crawlers-others_vektklubb_users',
                'span' => 1,
            ),
        ),
        array('id' => 'newsletterSubscriptionsCrawler',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'Subscriptions',
                'subtitle' => 'crawler',
                'processName' => 'crawlers-others_newsletter-subscriptions_subscriptions',
                'span' => 1,
            ),
        ),

        // MANIPULATORS
        array('id' => 'manipulationStructureMappingProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'Structure map',
                'subtitle' => 'manipulator',
                'processName' => 'manipulators_structuremapping:manipulators_structuremapping_00',
                'span' => 1,
            ),
        ),
        array('id' => 'manipulationSpidUserAccountsProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'SPiD useraccounts',
                'subtitle' => 'manipulator',
                'processName' => 'manipulators_useraccounts:manipulators_useraccounts',
                'span' => 1,
            ),
        ),

        // CLEANERS
        ['id' => 'cleaningSpidUsersProcess',
            'type' => 'process',
            'params' => [
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'SPiD users',
                'subtitle' => 'cleaner',
                'processName' => 'cleaners_cleaning-spidusers',
                'span' => 1,
            ],
        ],
        ['id' => 'cleaningVektklubbUsersProcess',
            'type' => 'process',
            'params' => [
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'VK users',
                'subtitle' => 'cleaner',
                'processName' => 'cleaners_cleaning-vektklubbusers',
                'span' => 1,
            ],
        ],

        // WRITERS
        array('id' => 'rawHadoopWriterProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'RAW Hadoop',
                'subtitle' => 'writer',
                'processName' => 'writers-raw:writers-raw_00',
                'span' => 1,
            ),
        ),
        array('id' => 'cleanHadoopWriterProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'CLEAN Hadoop',
                'subtitle' => 'writer',
                'processName' => 'writers-clean:writers-clean_00',
                'span' => 1,
            ),
        ),
        array('id' => 'cleanMysqlWriterProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'MySQL',
                'subtitle' => 'writer',
                'processName' => 'writers-mysql:writers-mysql_00',
                'span' => 1,
            ),
        ),

        // ADOBE CAMPAIGN
        array('id' => 'acExportClientsProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'AC clients',
                'subtitle' => 'export',
                'processName' => 'adobecampaign_clients',
                'span' => 1,
            ),
        ),
        array('id' => 'acExportClientConnectionsProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'AC client connection',
                'subtitle' => 'export',
                'processName' => 'adobecampaign_client-connections',
                'span' => 1,
            ),
        ),
        array('id' => 'acExportCustomerProductsProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'AC customer product',
                'subtitle' => 'export',
                'processName' => 'adobecampaign_customer-products',
                'span' => 1,
            ),
        ),
        array('id' => 'acExportCustomersProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'AC customers',
                'subtitle' => 'export',
                'processName' => 'adobecampaign_customers',
                'span' => 1,
            ),
        ),
        array('id' => 'acExportProductsProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'AC products',
                'subtitle' => 'export',
                'processName' => 'adobecampaign_products',
                'span' => 1,
            ),
        ),
        array('id' => 'acExportProductsProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
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
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'RAW Hadoop PUT',
                'subtitle' => 'script',
                'processName' => 'hadoop-put_raw',
                'span' => 1,
            ),
        ),
        array('id' => 'cleanHadoopPutProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'CLEAN Hadoop PUT',
                'subtitle' => 'script',
                'processName' => 'hadoop-put_clean',
                'span' => 1,
            ),
        ),

        // REGENERATION
        array('id' => 'regenerationHadoopProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'Hadoop regeneration',
                'subtitle' => 'writer',
                'processName' => 'writers-regeneration_hadoop:writers-regeneration_hadoop_00',
                'span' => 1,
            ),
        ),
        array('id' => 'regenerationMySQLProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'MySQL regeneration',
                'subtitle' => 'writer',
                'processName' => 'writers-regeneration_mysql:writers-regeneration_mysql_00',
                'span' => 1,
            ),
        ),
        array('id' => 'regenerationHadoopPutProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'supervisord',
                'metric' => 'processInfo',
                'title' => 'REGENERATION Hadoop PUT',
                'subtitle' => 'script',
                'processName' => 'hadoop-put_regeneration',
                'span' => 1,
            ),
        ),
        // QUEUES
        [
            'id' => 'integratorStructureMappingMessages',
            'type' => 'graph',
            'params' => [
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
            ],
        ],
        [
            'id' => 'integratorSpidUserAccountsManipulatorMessages',
            'type' => 'graph',
            'params' => [
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
            ],
        ],
        [
            'id' => 'integratorRawHadoopMessages',
            'type' => 'graph',
            'params' => [
                'dao' => 'rabbitMQ',
                'metric' => 'queuedMessages',
                'title' => 'Hadoop RAW',
                'span' => 1,
                'queueName' => 'integrator:raw:hadoop:newData:queue',
                'secondsBack' => '1200',
                'secondsIntervals' => '5',
                'refreshRate' => 5,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 1000000,
                'critical-value' => 5000000,
            ],
        ],
        [
            'id' => 'integratorCleanHadoopMessages',
            'type' => 'graph',
            'params' => [
                'dao' => 'rabbitMQ',
                'metric' => 'queuedMessages',
                'title' => 'Hadoop CLEAN',
                'span' => 1,
                'queueName' => 'integrator:clean:hadoop:newData:queue',
                'secondsBack' => '1200',
                'secondsIntervals' => '5',
                'refreshRate' => 5,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 1000000,
                'critical-value' => 5000000,
            ],
        ],
        [
            'id' => 'integratorCleanMysqlMessages',
            'type' => 'graph',
            'params' => [
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
            ],
        ],
        [
            'id' => 'integratorRegenerationHadoopMessages',
            'type' => 'graph',
            'params' => [
                'dao' => 'rabbitMQ',
                'metric' => 'queuedMessages',
                'title' => 'Hadoop',
                'subtitle' => 'regeneration',
                'span' => 1,
                'queueName' => 'integrator:clean:hadoop:regeneration:queue',
                'secondsBack' => '1200',
                'secondsIntervals' => '5',
                'refreshRate' => 5,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 1000000,
                'critical-value' => 5000000,
            ],
        ],
        [
            'id' => 'integratorRegenerationMysqlMessages',
            'type' => 'graph',
            'params' => [
                'dao' => 'rabbitMQ',
                'metric' => 'queuedMessages',
                'title' => 'MySQL',
                'subtitle' => 'regeneration',
                'span' => 1,
                'queueName' => 'integrator:clean:mysql:regeneration:queue',
                'secondsBack' => '1200',
                'secondsIntervals' => '5',
                'refreshRate' => 5,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 1000000,
                'critical-value' => 5000000,
            ],
        ],
        [
            'id' => 'integratorRabbitMemory',
            'type' => 'usage',
            'params' => [
                'dao' => 'rabbitMQ',
                'metric' => 'nodeMemoryUsage',
                'title' => 'RabbitMQ',
                'subtitle' => 'memory usage',
                'span' => 1,
                'nodeName' => 'rabbit@vg-rabbit-01',
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 12 * 1073741824,
                'critical-value' => 16 * 1073741824,
                'numericSystem' => 'binary',
            ],
        ],
        [
            'id' => 'integratorRabbitDiskUsage',
            'type' => 'usage',
            'params' => [
                'dao' => 'rabbitMQ',
                'metric' => 'nodeDiskUsage',
                'title' => 'RabbitMQ',
                'subtitle' => 'disk usage',
                'span' => 1,
                'nodeName' => 'rabbit@vg-rabbit-01',
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 50,
                'critical-value' => 75,
                'valueSuffix' => '%',
            ],
        ],
        [
            'id' => 'integratorServerLoad',
            'type' => 'graph',
            'params' => [
                'dao' => 'newRelic',
                'metric' => 'serverLoad',
                'title' => 'Server',
                'subtitle' => 'load',
                'valueSuffix' => '',
                'span' => 1,
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now',
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 6,
                'critical-value' => 8,
            ],
        ],
        [
            'id' => 'integratorServerNetworkReceived',
            'type' => 'graph',
            'params' => [
                'dao' => 'newRelic',
                'metric' => 'serverNetworkReceived',
                'title' => 'Server',
                'subtitle' => 'net received',
                'valueSuffix' => '',
                'span' => 1,
                'beginDateTime' => '-30 minutes',
                'endDateTime' => 'now',
                'numericSystem' => 'bandwidth',
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 75 * 104857600, // 75 mbit
                'critical-value' => 100 * 104857600, // 100 mbit
            ],
        ],
        [
            'id' => 'integratorApplicationDiskUsage',
            'type' => 'usage',
            'params' => [
                'dao' => 'newRelic',
                'metric' => 'diskUsage',
                'title' => 'Application',
                'subtitle' => 'disk usage',
                'span' => 1,
                'beginDateTime' => '-2 minutes',
                'endDateTime' => 'now',
                'diskName' => '^',
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 100 * 1073741824,
                'critical-value' => 150 * 1073741824,
                'numericSystem' => 'binary',
            ],
        ],
        [
            'id' => 'integratorApplicationMemoryUsage',
            'type' => 'usage',
            'params' => [
                'dao' => 'newRelic',
                'metric' => 'memoryUsage',
                'title' => 'Application',
                'subtitle' => 'memory usage',
                'span' => 1,
                'beginDateTime' => '-2 minutes',
                'endDateTime' => 'now',
                'diskName' => '^',
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 8 * 1073741824,
                'critical-value' => 12 * 1073741824,
                'numericSystem' => 'binary',
            ],
        ],
        [
            'id' => 'hadoopDiskUsage',
            'type' => 'usage',
            'params' => [
                'dao' => 'hadoop',
                'metric' => 'diskUsage',
                'title' => 'Hadoop',
                'subtitle' => 'disk usage',
                'span' => 1,
                'thresholdComparator' => 'lowerIsBetter',
                'caution-value' => 21990232555520, // 20TB
                'critical-value' => 32985348833280, // 30TB
                'numericSystem' => 'binary',
                'refreshRate' => 3600,
            ],
        ]
    ),
);
