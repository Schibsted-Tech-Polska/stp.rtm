<?php
namespace Dashboard\Model\Dao;

use DateTime;

/**
 * Class BambooDao
 *
 * @package Dashboard\Model\Dao
 */
class AtgTimeMetricsDao extends AbstractDao {

    function fetchThreshold(array $params = array()) {
        $threshold = array(
            'caution-value' => 10,
            'critical-value' => 60,
        );

        return $threshold;
    }

    function fetchAtgLatestActivityForErrorWidget(array $params = array()) {
        $responseJson = $this->request($params['url'], $params);
        return $responseJson['se.aftonbladet.trotting.atg.service.AtgImporterService']['latest_atg_events_import_minutes_ago']['value'];
    }

}