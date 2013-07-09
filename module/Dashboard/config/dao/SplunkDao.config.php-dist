<?php
return array(
    'url' => 'https://mother.int.vgnett.no:8089/services/search/jobs/export',
    'auth' => 'login:password',
    'jobs' => array(
        'vgtvStatus500' => array(
            'search' => 'search sourcetype=apache_access host=vgtv-web-* status=500 | top url',
            'earliest_time' => '-24h',
            'latest' => 'now',
            'output_mode' => 'json_cols',
        )
    )
);
