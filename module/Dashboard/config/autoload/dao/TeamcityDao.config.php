<?php
/**
 * @author: Krzysztof Wojcicki <krzysztof.wojcicki@schibsted.pl>
 */

return [
    'urls' => [
        'fetchFinishedBuildStatus'      => ':baseUrl:/httpAuth/app/rest/builds?buildType=:job:&count=1&locator=running:false',
        'fetchRunningBuildStatus'       => ':baseUrl:/httpAuth/app/rest/builds?buildType=:job:&count=1&locator=running:true',
        'fetchDetailedBuildStatusById'  => ':baseUrl:/httpAuth/app/rest/builds/id::id:',
        'fetchChangeByRevision'         => ':baseUrl:/httpAuth/app/rest/changes/version::revision:',
        'fetchCoverageById'             => ':baseUrl:/repository/download/:job:/:id::id/.teamcity/.NETCoverage/coverage.zip!/index.html',
        'fetchAverageHealthScore'       => ':baseUrl:/httpAuth/app/rest/builds?buildType=:job:',
        'fetchRecentBuilds'             => ':baseUrl:/httpAuth/app/rest/builds?buildType=:job:&count=10&locator=running:any',
        'fetchRecentChanges'            => ':baseUrl:/httpAuth/app/rest/changes?count=10',
        'fetchUserName'                 => ':baseUrl:/httpAuth/app/rest/users',
    ],
    'auth' => [
        'username' => '--username--',
        'password' => '--password--'
    ],
];
