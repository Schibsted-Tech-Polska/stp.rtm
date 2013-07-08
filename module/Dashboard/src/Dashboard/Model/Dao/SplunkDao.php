<?php
namespace Dashboard\Model\Dao;

use Zend\Json\Json;

/**
 * Class SplunkDao
 *
 * @package Dashboard\Model\Dao
 */
class SplunkDao extends AbstractDao {
    /**
     * Fetch status 500 for vgtv
     *
     * @param array $params Params
     * @return array
     */
    public function fetchFivehundredsForAlertWidget(array $params = array()) {
        // Get JSON
        $splunkJson = $this->request($this->config['url'], array(), 'json', $this->config['auth'], $this->config['jobs'][$params['config']]);

        if ($splunkJson) {
            return $splunkJson['columns'][0];
        } else {
            return array();
        }
    }
}
