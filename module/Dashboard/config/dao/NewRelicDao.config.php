<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

return array(
    'urls' => array(
        'fetchFeRpmForNumberWidget' => 'https://api.newrelic.com/api/v1/accounts/:accountId:/applications/:appId:/data.json?metrics[]=EndUser&field=requests_per_minute&begin=:beginDateTime:&end=:endDateTime:',
        'fetchRpmForGraphWidget' => 'https://api.newrelic.com/api/v1/accounts/:accountId:/applications/:appId:/data.json?metrics[]=HttpDispatcher&field=requests_per_minute&begin=:beginDateTime:&end=:endDateTime:',
        'fetchThresholdValues' => 'https://api.newrelic.com/api/v1/accounts/:accountId:/applications/:appId:/threshold_values.xml',
        'fetchCpuUsageForGraphWidget' => 'https://api.newrelic.com/api/v1/accounts/:accountId:/applications/:appId:/data.json?metrics[]=CPU/User Time&field=percent&begin=:beginDateTime:&end=:endDateTime:',
        'fetchAverageResponseTimeForGraphWidget' => 'https://api.newrelic.com/api/v1/accounts/:accountId:/applications/:appId:/data.json?metrics[]=HttpDispatcher&field=average_response_time&begin=:beginDateTime:&end=:endDateTime:'
    ),
);