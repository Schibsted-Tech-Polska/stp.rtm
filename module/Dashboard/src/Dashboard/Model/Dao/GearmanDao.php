<?php
namespace Dashboard\Model\Dao;

/**
 * Class GearmanDao
 *
 * @package Dashboard\Model\Dao
 */
class GearmanDao extends AbstractDao
{
    /**
     * Fetch jobs with workers attached
     *
     * @param  array $params Params
     * @return array
     */
    public function fetchJobsWithWorkersForGearmanWidget(array $params = [])
    {
        return $this->request($this->getEndpointUrl(__FUNCTION__), $params);
    }
}
