<?php
/**
 * Check for specified HTTP Status codes
 *
 * @author: Adam Łukaszczyk <adam.lukaszczyk@gmail.com>
 */

namespace Dashboard\Model\Dao;

use Zend\Http\Client\Exception\RuntimeException;
use Zend\Http\Response;
use Zend\Http\Client;

class HttpStatusDao extends AbstractDao
{

    /**
     * @return array
     */
    public function fetchThreshold()
    {
        $threshold = [
            'caution-value' => 300,
            'critical-value' => 400,
        ];

        return $threshold;
    }

    /**
     * @param array $params
     * @return int|mixed
     */
    public function fetchHttpStatusForNumberWidget(array $params = array())
    {
        try {
            $importJson = $this->request($params['url'], $params, 'plain');
            $status = $importJson->getStatusCode();
            return $status;
        } catch (RuntimeException $e) {
            $status = $e->getCode();

            // When non HTTP status code throw original error once again.
            if ($status == 0) {
                throw new RuntimeException(
                    $e->getMessage()
                );
            }

            return $status;
        }
    }
}
