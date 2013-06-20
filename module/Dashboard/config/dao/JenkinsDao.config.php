<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

return array(
    'urls' => array(
        'fetchStatusForBuildWidget' => 'http://ci.vgnett.no/view/:view:/job/:job:/api/json?pretty=true&depth=1',
        'fetchBuildStatus' => 'http://ci.vgnett.no/job/:job:/:buildNumber:/api/json?pretty=true&depth=1'
    ),
);