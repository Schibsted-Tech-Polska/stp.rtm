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
            $returnArray = array();
            foreach ($splunkJson['columns'][1] as $key => $url) {
                $returnArray[$key]['url'] = $url;
                $returnArray[$key]['numberOfErrors'] = $splunkJson['columns'][0][$key];
                $returnArray[$key]['lastErrorTime'] = $splunkJson['columns'][2][$key];
            }
            return $returnArray;
        } else {
            return array();
        }
    }
}
