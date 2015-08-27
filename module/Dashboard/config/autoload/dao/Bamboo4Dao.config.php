<?php
/**
 * @author: Wojciech Niemiec <wojciech.niemiec@schibsted.pl>
 */

return [
    'Bamboo4Dao' => [
        'urls' => [
            'fetchStatusForBuildWidget' => ':baseUrl:/rest/api/latest/result/:project:-:plan:?expand=results[0].result',
            'fetchRunningBuilds' => ':baseUrl:/chain/admin/ajax/getChains.action?planKey=:project:-:plan:',
        ],
    ],
];
