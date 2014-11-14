<?php
namespace Dashboard\Model\Dao;

/**
 * Class HadoopDao
 * @package Dashboard\Model\Dao
 */
class HadoopDao extends AbstractDao
{
    /**
     * @param array $params
     * @return mixed
     * @throws Exception\EndpointUrlNotDefined
     */
    public function fetchDiskUsageForUsageWidget(array $params = array())
    {
        $data = $this->request($this->getEndpointUrl(__FUNCTION__), $params);

        return [
            'current_value' => round(100 * $data['beans'][0]['Used']/$data['beans'][0]['Total'], 2),
            'minimum_value' => 0,
            'maximum_value' => 100,
        ];
//        return [
//            'current_value' => $data['beans'][0]['Used'],
//            'minimum_value' => 0,
//            'maximum_value' => $data['beans'][0]['Total'],
//        ];
    }

    /**
     * @param $params
     * @return array
     */
    public function fetchThreshold($params)
    {
        $threshold = array(
            'caution-value' => isset($params['caution-value']) ? $params['caution-value'] : 0,
            'critical-value' => isset($params['critical-value']) ? $params['critical-value'] : 0,
        );

        return $threshold;
    }
}
