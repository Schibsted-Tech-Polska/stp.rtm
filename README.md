
![ScreenShot](screenshot.png "Dashboard")

[![Build Status](https://travis-ci.org/Schibsted-Tech-Polska/stp.rtm.svg?branch=master)](https://travis-ci.org/Schibsted-Tech-Polska/stp.rtm)
[![Coverage Status](https://coveralls.io/repos/Schibsted-Tech-Polska/stp.rtm/badge.png?branch=master)](https://coveralls.io/r/Schibsted-Tech-Polska/stp.rtm?branch=master)

## Dependencies
- php >= 5.4
- cURL
- [Zend Framework ~2.3](http://framework.zend.com/)
- [Doctrine-mongo-odm-module](https://packagist.org/packages/doctrine/doctrine-mongo-odm-module)
- [Whoops](https://github.com/filp/whoops) error handler
- MongoDB PHP driver
- MongoDB server (required only by Message widget)

#### Suggestions
- [rake](http://rake.rubyforge.org/) provides the easiest setup

## Installation

The recommended way to get a working copy of this project is to clone the repository
and use `rake` to perform installation and initial setup. To do that, please go to the newly cloned directory and execute:

    $ rake

By default environment is set to **production**, for more verbose error reporting switch to **development** by executing:

    $ rake composer:dev setEnv[development]

To go back to **production** just rerun

    $ rake

## Available data sources

#### Popular sources

- **[Bamboo](https://www.atlassian.com/software/bamboo)** - Continuous Integration & Build Server
- **[GearmanUI](http://gaspaio.github.io/gearmanui/)** - PHP application providing a minimal monitoring dashboard for a cluster of Gearman Job Servers
- **[HipChat](https://www.hipchat.com/)** - Private group chat and IM, business and team collaboration
- **[Jenkins](http://jenkins-ci.org/)** - An extendable open source continuous integration server
- **[New Relic](http://newrelic.com/)** - Software analytics platform
- **[Splunk](http://www.splunk.com/)** - Operational Intelligence, Log Management, Application Management, Enterprise Security and Compliance
- **[Teamcity](http://www.jetbrains.com/teamcity/)** - Continuous Integration for Everybody
- **[Http Status]** - Checks HTTP status of given URL

#### Custom sources ;)
 - **Events** - listing events saved in MongoDB (these can be pretty much anything you want)

#### The crazy ones ;)
- **[Smog](http://monitoring.krakow.pios.gov.pl/iseo/aktualne_stacja.php?stacja=005)** - Current air pollution levels

## Available types of widgets

- **Number** - Displays numeric value with percentage difference between current and previous value.
- **Graph** - Similar to Number widget but with additional graph displaying history of values.
- **Message** - Displays text messages that can be pushed to a database using REST API.
- **Build** - Displays current status of a build with additional info about build author and code coverage (if provided).
During a build process it shows progress bar. Widget relies on Jenkins REST API.
- **Error** - Similar to Number widget but with different behaviour when some errors appear.
- **Alert** - Shows urls that produced 500 status code (internal server error). Widget relies on Splunk REST API.

## Usage

### Configuring data source endpoints ###
Some of the supported data sources are decentralized, so you must set proper API URL.
These can all be set in `module/Dashboard/config/autoload/dao`. Each data source has its Dao class.
During installation `rake` copies the `-dist` files into their respectable `.php` equivalents,
but the values need to be set manually.

For example, to setup Splunk edit `module/Dashboard/config/autoload/dao/SplunkDao.config.php`
and modify `url` and `auth` keys to match your setup.


    return [
        'SplunkDao' => [
            'url' => 'https://localhost:8089/services/search/jobs/export',
            'auth' => 'login:password',
            'jobs' => [
                'errors500' => [
                    'search' => 'search sourcetype=apache_access status=500 | top url',
                    'earliest_time' => '-240h',
                    'latest' => 'now',
                    'output_mode' => 'json_cols',
                ],
            ],
        ],
    ];



In order to run Stp.Rtm you have to specify configuration file for each of your dashboards. All configuration
 files should be placed under "/config/rtm/" directory.

### Defining dashboard instance configuration file

Below you can find a template and two examples of configuration files. The configuration file should contain
 a list of all widgets that you want to display on your dashboard.
For each widget you have to specify its unique id, type and all of required parameters.
If you want to use NewRelic's API you have to provide additional information like x-api-key and accountId.

**The template of a configuration file**

    return array(
        'theme' = '%YOUR_THEME_NAME%', // (optional) default 'dark'
        'newRelic' => array(
            'headers' => array(
                'x-api-key' => '%API_KEY%',
            ),
            'params' => array(
                'accountId' => '%ACCOUNT_ID%',
            ),
        ),
        'widgets' => array(
            array('id' => '%UNIQUE_TO_DASHBOARD_WIDGET_ID%',
                'type' => 'messages',
                'params' => array(
                    'dao' => 'messages',
                    'metric' => 'messages',
                    'span' => '%WIDGET_WIDTH%', // widget width, accepted values: 1-12
                    'title' => '%WIDGET_TITLE%', // string title
                ),
            ),
            array('id' => '%UNIQUE_TO_DASHBOARD_WIDGET_ID%',
                'type' => 'alert',
                'params' => array(
                    'dao' => 'splunk',
                    'metric' => 'Fivehundreds',
                    'title' => '%WIDGET_TITLE%',// string title (optional)
                    'subtitle' => '%WIDGET_SUBTITILE%', // string subtitle (optional)
                    'config' => '%SPLUNKS_JOB_NAME%', // splunk's job name
                ),
            ),
            array('id' => '%UNIQUE_TO_DASHBOARD_WIDGET_ID%',
                'type' => 'number',
                'params' => array(
                    'dao' => '%DAO_TO_FETCH_DATA%',
                    'metric' => '%METRIC_NAME_TO_PRESENT',
                    'title' => '%WIDGET_TITLE%', // string title (optional)
                    'subtitle' => '%WIDGET_SUBTITILE%', // string subtitle (optional)
                    'span' => '%WIDGET_WIDTH%', // widget width, accepted values: 1-12 (optional)
                    'valuePrefix' => '%VALUE_PREFIX%', // string value to be displayed in front of the value (optional)
                    'valueSuffix' => '%VALUE_SUFFIX%', // string value to be displayed after the value (optional)
                ),
            ),
            array('id' => '%UNIQUE_TO_DASHBOARD_WIDGET_ID%',
                'type' => 'error',
                'params' => array(
                    'dao' => 'newRelic',
                    'metric' => 'errorRate',
                    'appId' => '%NEW_RELIC_APP_ID%',
                    'title' => '%WIDGET_TITLE%', // string title (optional)
                    'subtitle' => '%WIDGET_SUBTITILE%', // string subtitle (optional)
                    'span' => '%WIDGET_WIDTH%', // widget width, accepted values: 1-12 (optional)
                    'valuePrefix' => '%VALUE_PREFIX%', // string value to be displayed in front of the value (optional)
                    'valueSuffix' => '%', // string value to be displayed after the value (optional)
                ),
            ),

            array('id' => '%UNIQUE_TO_DASHBOARD_WIDGET_ID%',
                'type' => 'graph',
                'params' => array(
                    'dao' => 'newRelic',
                    'metric' => 'cpuUsage',
                    'appId' => '%NEW_RELIC_APP_ID%',
                    'title' => '%WIDGET_TITLE%', // string title (optional)
                    'subtitle' => '%WIDGET_SUBTITILE%', // string subtitle (optional)
                    'span' => '%WIDGET_WIDTH%', // widget width, accepted values: 1-12 (optional)
                    'valuePrefix' => '%VALUE_PREFIX%', // string value to be displayed in front of the value (optional)
                    'valueSuffix' => '%', // string value to be displayed after the value (optional)
                    'beginDateTime' => '-30 minutes', // start time for collecting data for the graph
                    'endDateTime' => 'now', // end time for collecting data for the graph
                ),
            ),
            array('id' => '%UNIQUE_TO_DASHBOARD_WIDGET_ID%',
                'type' => 'build',
                'params' => array(
                    'dao' => 'jenkins',
                    'view' => '%VIEW_NAME%', // Jenkins view name (from URL)
                    'job' => '%JOB_NAME%', // Jenkins job name (from URL)
                    'metric' => 'status',
                    'title' => '%WIDGET_TITLE%', // string title (optional)
                    'subtitle' => '%WIDGET_SUBTITILE%', // string subtitle (optional)
                    'span' => '%WIDGET_WIDTH%', // widget width, accepted values: 1-12 (optional)
                    'valuePrefix' => '%VALUE_PREFIX%', // string value to be displayed in front of the value (optional)
                    'valueSuffix' => '%', // string value to be displayed after the value (optional)
                ),
            ),
        ),
    );


**Sample configuration for NewRelic**

     /**
      * This is a sample project-specific NewRelic dashboard.
      * It consists of a all available NewRelic widgets for a single application.
      * All you have to do is replace variables surronded with '%' char with your data.
      */
     return array(
         'newRelic' => array(
             'headers' => array(
                 'x-api-key' => '%X_API_KEY%',
             ),
             'params' => array(
                 'accountId' => '%ACCOUNT_ID%',
                 'appId' => '%APPLICATION_ID%',
             ),
         ),
         'widgets' => array(
             array('id' => 'messages',
                 'type' => 'messages',
                 'params' => array(
                     'dao' => 'events',
                     'metric' => 'messages',
                     'span' => 6,
                     'title' => 'Sample project',
                     'limit' => 10,
                 ),
             ),
             array('id' => '%WIDGET_ID_1%',
                 'type' => 'graph',
                 'params' => array(
                     'dao' => 'newRelic',
                     'metric' => 'feRpm',
                     'span' => 3,
                     'beginDateTime' => '-30 minutes',
                     'endDateTime' => 'now',
                     'title' => 'Frontend RPM',
                 ),
             ),
             array('id' => '%WIDGET_ID_2%',
                 'type' => 'graph',
                 'params' => array(
                     'dao' => 'newRelic',
                     'metric' => 'rpm',
                     'span' => 6,
                     'beginDateTime' => '-30 minutes',
                     'endDateTime' => 'now',
                     'title' => 'Backend RPM',
                 ),
             ),

             array('id' => '%WIDGET_ID_2%',
                 'type' => 'graph',
                 'params' => array(
                     'dao' => 'newRelic',
                     'metric' => 'cpuUsage',
                     'title' => 'CPU USAGE',
                     'valueSuffix' => '%',
                     'span' => 6,
                     'beginDateTime' => '-30 minutes',
                     'endDateTime' => 'now',
                 ),
             ),
             array('id' => '%WIDGET_ID_3%',
                 'type' => 'graph',
                 'params' => array(
                     'dao' => 'newRelic',
                     'metric' => 'averageResponseTime',
                     'title' => 'Average response time',
                     'span' => 6,
                     'valueSuffix' => 'ms',
                     'beginDateTime' => '-30 minutes',
                     'endDateTime' => 'now',
                 ),
             ),

             array('id' => '%WIDGET_ID_4%',
                 'type' => 'number',
                 'params' => array(
                     'dao' => 'newRelic',
                     'metric' => 'memory',
                     'title' => 'MEMORY',
                     'valueSuffix' => 'MB',
                 ),
             ),
             array('id' => '%WIDGET_ID_5%',
                 'type' => 'numberWithNewRelicThreshold',
                 'params' => array(
                     'dao' => 'newRelic',
                     'metric' => 'apdex',
                     'title' => 'Apdex',
                     'thresholdComparator' => 'higherIsBetter',
                 ),
             ),
             array('id' => '%WIDGET_ID_6%',
                 'type' => 'error',
                 'params' => array(
                     'dao' => 'newRelic',
                     'valueSuffix' => '%',
                     'metric' => 'errorRate',
                     'title' => 'ERROR RATE',
                     'thresholdComparator' => 'lowerIsBetter',
                 ),
             ),
             array('id' => '%WIDGET_ID_7%',
                 'type' => 'alert',
                 'params' => array(
                     'dao' => 'splunk',
                     'metric' => 'Fivehundreds',
                     'title' => 'Splunk',
                     'subtitle' => 'Status code 500',
                     'config' => '%SPLUNKS_JOB_NAME%'
                 ),
             ),
         ),
     );

**Sample configuration for Jenkins**

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


## Running dashboard

Assuming that [http://localhost](http://localhost) serves index.php from the projects /public directory, you can run your
dashboard instance by adding the name of the configuration file saved into `config/rtm` folder to the URL
e.g.

- `config/rtm/myFirstDashboard.config.php` --> [http://localhost/myFirstDashboard](http://localhost/myFirstDashboard)
