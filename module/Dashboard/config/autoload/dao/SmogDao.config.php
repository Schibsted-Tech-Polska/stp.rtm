<?php
/**
 * @author: Krzysztof Wojcicki <krzysztof.wojcicki@schibsted.pl>
 */

return [
    'SmogDao' => [
        'urls' => [
            'fetchForSmogWidget' => 'http://monitoring.krakow.pios.gov.pl/iseo/aktualne_stacja.php?stacja=005',
        ],
        'norms' => [
            'CO' => 10000,
            'NO' => null,
            'NO2' => 200,
            'NOX' => 30,
            'PM10' => 50,
            'PM2.5' => 25,
            'SO2' => 350,
        ],
    ],
];
