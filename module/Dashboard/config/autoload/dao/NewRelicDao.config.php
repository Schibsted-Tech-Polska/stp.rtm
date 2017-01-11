<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */
namespace Dashboard\Model\Dao;

final class NewRelicAddresses {
    const TOTAL_MEMORY = 'fetchTotalMemory';
    const AVG_HOST_MEMORY = 'fetchMemoryAvg';
    const HOST_MEMORY = 'fetchMemoryUsage';
}

return [
    'NewRelicDao' => [
        'urls' => [
            'fetchFeRpmForGraphWidget' =>
                'https://api.newrelic.com/api/v1/accounts/:accountId:/applications/:appId:/data.json'
                . '?metrics[]=EndUser&field=requests_per_minute&begin=:beginDateTime:&end=:endDateTime:',
            'fetchRpmForGraphWidget' =>
                'https://api.newrelic.com/api/v1/accounts/:accountId:/applications/:appId:/data.json'
                . '?metrics[]=HttpDispatcher&field=requests_per_minute&begin=:beginDateTime:&end=:endDateTime:',
            'fetchThresholdValues' =>
                'https://api.newrelic.com/api/v1/accounts/:accountId:/applications/:appId:/threshold_values.xml',
            'fetchThreshold' =>
                'https://api.newrelic.com/api/v1/accounts/:accountId:/applications/:appId:/thresholds.xml',
            'fetchCpuUsageForGraphWidget' =>
                'https://api.newrelic.com/api/v1/accounts/:accountId:/applications/:appId:/data.json'
                . '?metrics[]=CPU/User Time&field=percent&begin=:beginDateTime:&end=:endDateTime:',
            'fetchAverageResponseTimeForGraphWidget' =>
                'https://api.newrelic.com/api/v1/accounts/:accountId:/applications/:appId:/data.json'
                . '?metrics[]=HttpDispatcher&field=average_response_time&begin=:beginDateTime:&end=:endDateTime:',
            'fetchEvents' => 'https://rpm.newrelic.com/account_feeds/:feed:/applications/:appId:/events.rss',
            'fetchDiskUsageForUsageWidget' =>
                'https://api.newrelic.com/v2/servers/:serverId:/metrics/data.json'
                . '?names[]=System/Filesystem/:diskName:/Used/bytes&values[]=average_response_time'
                . '&values[]=average_exclusive_time&from=:beginDateTime:&end=:endDateTime:&summarize=true',
            'fetchMemoryUsageForUsageWidget' =>
                'https://api.newrelic.com/v2/servers/:serverId:/metrics/data.json'
                . '?names[]=System/Memory/Used/bytes&values[]=average_response_time'
                . '&values[]=average_exclusive_time&from=:beginDateTime:&end=:endDateTime:&summarize=true',
            NewRelicAddresses::AVG_HOST_MEMORY =>
                'https://api.newrelic.com/v2/applications/:appId:/metrics/data.json'
                . '?names[]=Memory/Physical&values[]=used_mb_by_host&summarize=true'
                . '&from=:beginDateTime:&end=:endDateTime:',
            NewRelicAddresses::TOTAL_MEMORY =>
                'https://api.newrelic.com/v2/applications/:appId:/metrics/data.json'
                . '?names[]=Memory/Physical&values[]=total_used_mb&summarize=true'
                . '&from=:beginDateTime:&end=:endDateTime:',
            NewRelicAddresses::HOST_MEMORY =>
                'https://api.newrelic.com/v2/applications/:appId:/metrics/data.json'
                . '?names[]=Memory/Physical&values[]=used_mb_by_host&summarize=false'
                . '&from=:beginDateTime:&end=:endDateTime:',
            'fetchServerCpuUsageForGraphWidget' =>
                'https://api.newrelic.com/v2/servers/:serverId:/metrics/data.json'
                . '?names[]=System/CPU/System/percent&names[]=System/CPU/User/percent'
                . '&values[]=average_value&from=:beginDateTime:&end=:endDateTime:',
            'fetchServerLoadForGraphWidget' =>
                'https://api.newrelic.com/v2/servers/:serverId:/metrics/data.json' .
                '?names[]=System/Load&values[]=average_value&from=:beginDateTime:&end=:endDateTime:',
            'fetchServerNetworkReceivedForGraphWidget' =>
                'https://api.newrelic.com/v2/servers/:serverId:/metrics/data.json' .
                '?names[]=System/Network/All/Received/bytes/sec&values[]=per_second' .
                '&from=:beginDateTime:&end=:endDateTime:',
        ],
    ],
];
