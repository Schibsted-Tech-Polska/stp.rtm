<?php
namespace Dashboard\Model\Dao;

use Supervisor\Connector\Zend;
use Supervisor\Supervisor;
use Zend\XmlRpc\Client;

/**
 * Class SupervisordDao
 * @package Dashboard\Model\Dao
 */
class SupervisordDao extends AbstractDao
{
    /**
     * @var \Supervisor\Supervisor
     */
    private $supervisorClient;

    /**
     * @return Supervisor
     */
    public function getSupervisorClient($params)
    {
        if (!$this->supervisorClient) {
            $mergedParams = array_replace_recursive($this->getDaoParams(), $params);
            $client = new Client($mergedParams['baseUrl']);
            $connector = new Zend($client);
            $this->supervisorClient = new Supervisor($connector);
        }

        return $this->supervisorClient;
    }

    /**
     * @param Supervisor $supervisorClient
     */
    public function setSupervisorClient($supervisorClient)
    {
        $this->supervisorClient = $supervisorClient;
    }

    /**
     * Fetch all processes
     *
     * @param  array $params Params
     * @return array
     */
    public function fetchAllProcessesForSupervisordWidget(array $params = array())
    {
        return $this->getSupervisorClient($params)->getAllProcessInfo();
    }

    /**
     * Fetch one process
     *
     * @param  array $params Params
     * @return array
     */
    public function fetchProcessInfoForProcessWidget(array $params = array())
    {
        return $this->getSupervisorClient($params)->getProcessInfo($params['processName']);
    }
}
