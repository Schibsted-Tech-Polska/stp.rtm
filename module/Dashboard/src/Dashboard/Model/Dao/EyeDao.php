<?php
namespace Dashboard\Model\Dao;

/**
 * Class EyeDao
 *
 * @package Dashboard\Model\Dao
 */
class EyeDao extends AbstractDao
{
    /**
     * Fetch all processes
     *
     * @param  array $params Params
     * @return array
     */
    public function fetchInfoForEyeWidget(array $params = array())
    {
        return $this->request($this->getEndpointUrl(__FUNCTION__), $params);
    }

    /**
     * Fetch one process
     *
     * @param  array $params Params
     * @return array
     */
    public function fetchInfoForEyeProcessWidget(array $params = array())
    {
        return $this->request($this->getEndpointUrl(__FUNCTION__), $params);
    }
}
