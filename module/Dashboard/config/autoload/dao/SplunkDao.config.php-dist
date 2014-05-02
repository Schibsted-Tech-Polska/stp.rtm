<?php
return [
    'SplunkDao' => [
        'url' => 'https://localhost:8089/services/search/jobs/export',
        'auth' => 'login:password',
        'jobs' => [
            'vgtvStatus500' => [
                'search' => 'search sourcetype=apache_access host=vgtv-web-* status=500 | top url',
                'earliest_time' => '-240h',
                'latest' => 'now',
                'output_mode' => 'json_cols',
            ],
            'godtStatus500' => [
                'search' => 'search sourcetype=apache_access NOT(toolbox) host=godt-web-* OR host=red-web-* status=500 | stats count latest(_time) as latestTime by url | sort -count | head 5',
                'earliest_time' => '-24h',
                'latest' => 'now',
                'output_mode' => 'json_cols',
            ],
            'vektklubbApiStatus500' => [
                'search' => 'search sourcetype=apache_access NOT(toolbox) host=vektklubb-api-s* status=500 | stats count latest(_time) as latestTime by url | sort -count | head 5',
                'earliest_time' => '-24h',
                'latest' => 'now',
                'output_mode' => 'json_cols',
            ],
        ],
    ],
];

