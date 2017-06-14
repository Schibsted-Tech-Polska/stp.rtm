<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */
namespace Dashboard\Model\Dao;

return [
    'VarnishDao' => [
        'urls' => [
            'fetchRpmForIncrementalGraphWidget' => ':baseUrl:/key/:key:',
            'fetchHitRateForIncrementalGraphWidget' => ':baseUrl:/key/:key:',
            'fetchHitRateForUsageWidget' => ':baseUrl:/key/:key:',
        ],
    ],
];
