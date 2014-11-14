<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

return [
    'NewRelicDao' => [
        'urls' => [
            'fetchFeRpmForGraphWidget' => 'https://api.newrelic.com/api/v1/accounts/:accountId:/applications/:appId:/data.json?metrics[]=EndUser&field=requests_per_minute&begin=:beginDateTime:&end=:endDateTime:',
            'fetchRpmForGraphWidget' => 'https://api.newrelic.com/api/v1/accounts/:accountId:/applications/:appId:/data.json?metrics[]=HttpDispatcher&field=requests_per_minute&begin=:beginDateTime:&end=:endDateTime:',
            'fetchThresholdValues' => 'https://api.newrelic.com/api/v1/accounts/:accountId:/applications/:appId:/threshold_values.xml',
            'fetchThreshold' => 'https://api.newrelic.com/api/v1/accounts/:accountId:/applications/:appId:/thresholds.xml',
            'fetchCpuUsageForGraphWidget' => 'https://api.newrelic.com/api/v1/accounts/:accountId:/applications/:appId:/data.json?metrics[]=CPU/User Time&field=percent&begin=:beginDateTime:&end=:endDateTime:',
            'fetchAverageResponseTimeForGraphWidget' => 'https://api.newrelic.com/api/v1/accounts/:accountId:/applications/:appId:/data.json?metrics[]=HttpDispatcher&field=average_response_time&begin=:beginDateTime:&end=:endDateTime:',
            'fetchEvents' => 'https://rpm.newrelic.com/account_feeds/:feed:/applications/:appId:/events.rss',
            'fetchDiskUsageForUsageWidget' => 'https://api.newrelic.com/v2/servers/:serverId:/metrics/data.json?names[]=System/Filesystem/:diskName:/Used/bytes&values[]=average_response_time&values[]=average_exclusive_time&from=:beginDateTime:&end=:endDateTime:&summarize=true',
            'fetchMemoryUsageForUsageWidget' => 'https://api.newrelic.com/v2/servers/:serverId:/metrics/data.json?names[]=System/Memory/Used/bytes&values[]=average_response_time&values[]=average_exclusive_time&from=:beginDateTime:&end=:endDateTime:&summarize=true',
            'fetchServerCpuUsageForGraphWidget' => 'https://api.newrelic.com/v2/servers/:serverId:/metrics/data.json?names[]=System/CPU/System/percent&names[]=System/CPU/User/percent&values[]=average_value&from=:beginDateTime:&end=:endDateTime:',
        ],
    ],
];
