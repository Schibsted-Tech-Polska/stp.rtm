<?php
/**
 * IMBO Image Server DAO
 *
 * @author: Adam Łukaszczyk <adam.lukaszczyk@gmail.com>
 */

namespace Dashboard\Model\Dao;

class ImboDao extends AbstractDao {


    function fetchThreshold() {
        $threshold = array(
            'caution-value' => 1,
            'critical-value' => 1,
        );

        return $threshold;
    }

    private $fetchedData = null;

    private function getData(array $params = array()) {
        if ($this->fetchedData == null) {
            $this->fetchedData = $this->request($params['url'], $params);
        }

        return $this->fetchedData;

    }

    function fetchImboAllForErrorWidget(array $params = array()) {
        $data = $this->getData($params);

        if ($data['storage'] == 1 && $data['database'] == 1) {
            return 0;
        }
        else {
            return 1;
        }
    }

    function fetchImboStorageForErrorWidget(array $params = array()) {
        $data = $this->getData($params);

        if ($data['storage'] == 1) {
            return 0;
        }
        else {
            return 1;
        }
    }

    function fetchImboDatabaseForErrorWidget(array $params = array()) {
        $data = $this->getData($params);

        if ($data['database'] == 1) {
            return 0;
        }
        else {
            return 1;
        }
    }

}