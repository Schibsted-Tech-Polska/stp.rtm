<?php
/**
 * IMBO Image Server DAO
 *
 * @author: Adam Łukaszczyk <adam.lukaszczyk@gmail.com>
 */

namespace Dashboard\Model\Dao;

class ImboDao extends AbstractDao
{
    private $fetchedData = null;

    /**
     * @return array
     */
    public function fetchThreshold()
    {
        $threshold = [
            'caution-value' => 1,
            'critical-value' => 1,
        ];

        return $threshold;
    }

    /**
     * @param array $params
     * @return mixed|null
     */
    private function getData(array $params = [])
    {
        if ($this->fetchedData == null) {
            $this->fetchedData = $this->request($params['url'], $params);
        }

        return $this->fetchedData;
    }

    /**
     * @param array $params
     * @return int
     */
    public function fetchImboAllForErrorWidget(array $params = [])
    {
        $data = $this->getData($params);

        if ($data['storage'] == 1 && $data['database'] == 1) {
            return 0;
        } else {
            return 1;
        }
    }

    /**
     * @param array $params
     * @return int
     */
    public function fetchImboStorageForErrorWidget(array $params = [])
    {
        $data = $this->getData($params);

        if ($data['storage'] == 1) {
            return 0;
        } else {
            return 1;
        }
    }

    /**
     * @param array $params
     * @return int
     */
    public function fetchImboDatabaseForErrorWidget(array $params = [])
    {
        $data = $this->getData($params);

        if ($data['database'] == 1) {
            return 0;
        } else {
            return 1;
        }
    }
}
