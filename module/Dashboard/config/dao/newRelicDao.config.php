<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

return array(
    'urls' => array(
        'fetchRpmForGraphWidget' => 'https://api.newrelic.com/api/v1/accounts/:accountId:/applications/:appId:/data.json?metrics[]=HttpDispatcher&field=requests_per_minute&begin=:beginDateTime:&end=:endDateTime:',
        'fetchErrorRateForGraphWidget' => 'https://api.newrelic.com/api/v1/accounts/:accountId:/applications/:appId:/data.json?metrics[]=Errors/all&field=errors_per_minute&begin=:beginDateTime:&end=:endDateTime:',
        'fetchCpuUsageForGraphWidget' => 'https://api.newrelic.com/api/v1/accounts/:accountId:/applications/:appId:/data.json?metrics[]=CPU/User Time&field=percent&begin=:beginDateTime:&end=:endDateTime:',
        'fetchAverageResponseTimeForGraphWidget' => 'https://api.newrelic.com/api/v1/accounts/:accountId:/applications/:appId:/data.json?metrics[]=HttpDispatcher&field=average_response_time&begin=:beginDateTime:&end=:endDateTime:',
        'fetchMemoryForGraphWidget' => 'https://api.newrelic.com/api/v1/accounts/:accountId:/applications/:appId:/data.json?metrics[]=Memory/Physical&field=used&begin=:beginDateTime:&end=:endDateTime:',
    ),
);