<?php
/**
 * Check for specified HTTP Status codes
 *
 * @author: Adam Łukaszczyk <adam.lukaszczyk@gmail.com>
 */

namespace Dashboard\Model\Dao;

use Zend\Http\Response;
use Zend\Http\Client;

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
        } catch(\Zend\Http\Client\Exception\RuntimeException $e) {
            $status = $e->getCode();

            // When non HTTP status code throw original error once again.
            if ($status == 0) {
                throw new Client\Exception\RuntimeException(
                    $e->getMessage()
                );
            }

            return $status;
        }
    }
}