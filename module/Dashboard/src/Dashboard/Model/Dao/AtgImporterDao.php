<?php
namespace Dashboard\Model\Dao;

use DateTime;

/**
 * Class BambooDao
 *
 * @package Dashboard\Model\Dao
 */
class AtgImporterDao extends AbstractDao {


    function fetchThreshold(array $params = array()) {
        $threshold = array(
            'caution-value' => 1,
            'critical-value' => 10,
        );

        return $threshold;
    }

    function fetchAtgEventsForErrorWidget(array $params = array()) {
        $importJson = $this->request($params['url'], $params);

        $lastReportsWithErrors = $importJson['eventsProcessingResultsWithErrors'];
        $datetime = new DateTime();
        $limit = $datetime->sub(date_interval_create_from_date_string('4 days'))->getTimestamp();
        $count = 0;
        foreach ($lastReportsWithErrors as $reportWithErrors) {
            if ($limit < $reportWithErrors['date'] / 1000) {
                $count++;
            }
        }

        return $count;
    }

    function fetchBetEventsForErrorWidget(array $params = array()) {
        $importJson = $this->request($params['url'], $params);

        $lastBetEventImports = $importJson['fetchingResults'];
        $count = 0;
        foreach ($lastBetEventImports as $import) {
            if (!$import['success']) {
                $count++;
            }
        }
        $params['valuePrefix'] = '%';

        return $count;
    }

}