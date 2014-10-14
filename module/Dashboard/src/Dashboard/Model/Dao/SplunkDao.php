<?php
namespace Dashboard\Model\Dao;

use Dashboard\Model\Dao\Exception\EndpointUrlNotAssembled;

/**
 * Class SplunkDao
 *
 * @package Dashboard\Model\Dao
 */
class SplunkDao extends AbstractDao
{
    /**
     * Fetch status 500 for vgtv
     *
     * @param  array $params Params
     * @return array
     */
    public function fetchFivehundredsForAlertWidget(array $params = array())
    {
        if (!isset($params['config']) || !is_array($params['config'])) {
            throw new EndpointUrlNotAssembled('You need to specify configure splunk job to use it!');
        }

        // Get JSON
        $splunkJson = $this->request(
            $this->getEndpointUrl(__FUNCTION__),
            $params,
            'json',
            $this->daoOptions['auth'],
            $params['config']
        );

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
