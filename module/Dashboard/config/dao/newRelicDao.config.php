<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

return array(
    'urls' => array(
        'fetchRpmForNumberWidget' => 'https://api.newrelic.com/api/v1/accounts/:accountId:/applications/:appId:/data.json?metrics[]=EndUser&field=requests_per_minute&begin=:beginDateTime:&end=:endDateTime:',
    ),
);