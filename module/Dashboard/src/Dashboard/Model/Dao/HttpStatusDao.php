<?php
/**
 * Check for specified HTTP Status codes
 *
 * @author: Adam Łukaszczyk <adam.lukaszczyk@gmail.com>
 */

namespace Dashboard\Model\Dao;

use Zend\Http\Response;

class HttpStatusDao extends AbstractDao {

    function fetchThreshold() {
        $threshold = array(
            'caution-value' => 300,
            'critical-value' => 400,
        );

        return $threshold;
    }

    function fetchHttpStatusForNumberWidget(array $params = array()) {
        try {
            $importJson = $this->request($params['url'], $params, 'plain');
            $status = $importJson->getStatusCode();
            return $status;
        } catch(\Exception $e) {
            $status = $e->getCode();
            return $status;
        }
    }
}