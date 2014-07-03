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

    function fetchHttpStatusForErrorWidget(array $params = array()) {
        $importJson = $this->request($params['url'], $params, 'plain', null, null, false);
        return $importJson->getStatusCode();
    }

}