<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

return [
    'JenkinsDao' => [
        'urls' => [
            'fetchStatusForBuildWidget' => ':baseUrl:/job/:job:/api/json?pretty=true&depth=1',
            'fetchBuildStatus' => ':baseUrl:/job/:job:/:buildNumber:/api/json?pretty=true&depth=1',
        ],
    ],
];
