<?php
/**
 * Base class for different widget types
 *
 * @author Konrad Turczynski <konrad.turczynski@schibsted.pl>
 */
namespace Dashboard\Model\Widget;

use Dashboard\Model\Dao\AbstractDao;

abstract class AbstractWidget {
    /**
     * Widget's identifier
     *
     * @var
     */
    protected $id;

    /**
     * Widget's custom parameters
     *
     * @var array
     */
    protected $params;

    /**
     * Dao object for concrete widget
     *
     * @var
     */
    protected $dao;

    /**
     * Response hash made from metric values
     *
     * @var
     */
    protected $responseHash;

    /**
     * Constructor
     *
     * @param array $params Merged parameters from custom and default widget config
     */
    public function __construct(array $params) {
        $this->params = $params;
    }

    /**
     * Returns data for metric specified in rtm config
     *
     * @return mixed
     */
    public function fetchData() {
        $methodName = 'fetch' . ucfirst($this->getParam('metric')) . 'For' . $this->getClassName();

        $response = $this->getDao()->$methodName($this->params);
        $this->setResponseHash($response);

        return $response;
    }

    /**
     * Returns widget specific parameter
     *
     * @param string $paramName Parameter name.
     * @return mixed
     * @throws \Exception
     */
    public function getParam($paramName) {
        if (isset($this->params[$paramName])) {
            return $this->params[$paramName];
        } else {
            throw new \Exception('Invalid widget parameter: ' . $paramName);
        }
    }

    /**
     * Prepares response hash using sha1 algorithm
     *
     * @param array $responseHash Array of response values
     */
    public function setResponseHash($responseHash) {
        $hash = sha1(serialize($responseHash));
        $this->responseHash = $hash;
    }

    /**
     * Returns response hash prepared from metric values
     *
     * @return mixed
     */
    public function getResponseHash() {
        return $this->responseHash;
    }

    /**
     * Returns name of the class without namespace
     *
     * @return string
     */
    public function getClassName() {
        $class = explode('\\', get_class($this));

        return end($class);
    }

    /**
     * Sets widget's dao
     *
     * @param AbstractDao $dao Concrete dao object
     */
    public function setDao(AbstractDao $dao) {
        $this->dao = $dao;
    }

    /**
     * Returns dao
     *
     * @return mixed
     */
    public function getDao() {
        return $this->dao;
    }

    /**
     * Sets widget identifier
     *
     * @param mixed $id Widget identifier
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * Returns widget identifier
     *
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }
}
