<?php
/**
 * Config for rtm
 */
return array(
    'theme' => ['tv', 'dark'],
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
            'eyeUrl' => 'http://integrator-cron-s01.int.vgnett.no:6937',
        ),
    ),
    'jenkins' => array(
        'params' => array(
            'baseUrl' => 'http://ci.vgnett.no/',
        ),
    ),
    'widgets' => array(

        // BUILDS
        array('id' => 'integratorCrawlersBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'integrator',
                'job' => 'integrator-crawlers',
                'metric' => 'status',
                'title' => 'Crawlers',
                'refreshRate' => 5,
                'span' => 1,
            ),
        ),
        array('id' => 'integratorInputDataManipulatorsBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'integrator',
                'job' => 'integrator-input-data-manipulators',
                'metric' => 'status',
                'title' => 'Manipulators',
                'refreshRate' => 5,
                'span' => 1,
            ),
        ),
        array('id' => 'integratorInputDataManipulatorsIntegrationBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'integrator',
                'job' => 'integrator-input-data-manipulators-integration',
                'metric' => 'status',
                'title' => 'Manipulators integration',
                'refreshRate' => 5,
                'span' => 1,
            ),
        ),
        array('id' => 'integratorDataCleanersBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'integrator',
                'job' => 'integrator-data-cleaners',
                'metric' => 'status',
                'title' => 'Cleaners',
                'refreshRate' => 5,
                'span' => 1,
            ),
        ),
        array('id' => 'integratorDataCleanersIntegrationBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'integrator',
                'job' => 'integrator-data-cleaners-integration',
                'metric' => 'status',
                'title' => 'Cleaners integration',
                'refreshRate' => 5,
                'span' => 1,
            ),
        ),
        array('id' => 'integratorDestinationWritersBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'integrator',
                'job' => 'integrator-destination-writers',
                'metric' => 'status',
                'title' => 'Destination writers',
                'refreshRate' => 5,
                'span' => 1,
            ),
        ),
        array('id' => 'integratorDestinationWritersIntegrationBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'integrator',
                'job' => 'integrator-destination-writers-integration',
                'metric' => 'status',
                'title' => 'Destination writers integration',
                'refreshRate' => 5,
                'span' => 1,
            ),
        ),
        array('id' => 'integratorManipulatorsCommonBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'integrator',
                'job' => 'integrator-manipulators-common',
                'metric' => 'status',
                'title' => 'Manipulators COMMON',
                'refreshRate' => 5,
                'span' => 1,
            ),
        ),
        array('id' => 'integratorWritersBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'integrator',
                'job' => 'integrator-writers',
                'metric' => 'status',
                'title' => 'Writers',
                'refreshRate' => 5,
                'span' => 1,
            ),
        ),
        array('id' => 'integratorNewsletterSubscriptionsBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'integrator',
                'job' => 'integrator-newsletter-subscriptions',
                'metric' => 'status',
                'title' => 'Subscriptions',
                'refreshRate' => 5,
                'span' => 1,
            ),
        ),
        array('id' => 'integratorNewsletterSubscriptionsIntegrationBuildStatus',
            'type' => 'build',
            'params' => array(
                'dao' => 'jenkins',
                'view' => 'integrator',
                'job' => 'integrator-newsletter-subscriptions-integration',
                'metric' => 'status',
                'title' => 'Subscriptions integration',
                'refreshRate' => 5,
                'span' => 1,
            ),
        ),

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
        // none for now...
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
        array('id' => 'hadoopPutProcess',
            'type' => 'process',
            'params' => array(
                'dao' => 'eye',
                'metric' => 'info',
                'title' => 'Hadoop PUT',
                'processName' => 'put',
                'span' => 1,
            ),
        ),

        // QUEUES
        array('id' => 'integratorRabbitMQQueues',
            'type' => 'rabbitMQ',
            'params' => array(
                'dao' => 'rabbitMQ',
                'metric' => 'queues',
                'title' => 'RabbitMQ',
                'span' => 3,
                'ignoreQueues' => ['.*testing.*', '.*:invalid:.*'],
                'queueNameParser' => function($queueName) { return str_replace(':queue', '', str_replace('integrator:', '', $queueName));},
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
            ),
        ),

        // MESSAGES
        array('id' => 'messagesIntegrator',
            'type' => 'messages',
            'params' => array(
                'dao' => 'hipChat',
                'metric' => 'listRecentMessages',
                'span' => 3,
                'subtitle' => '',
                'title' => 'Integrator',
                'limit' => 10,
                'room' => '678235',
                'refreshRate' => 30,
                'fromUser' => ['jenkins', 'Cap4All'],
            ),
        ),
    ),
);