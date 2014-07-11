<?php
/**
 * Base class for different widget types
 *
 * @author Konrad Turczynski <konrad.turczynski@schibsted.pl>
 */
namespace Dashboard\Model\Widget;

use Dashboard\Model\Dao\AbstractDao;
use Zend\Filter\Inflector;
use Zend\View\Model\ViewModel;

abstract class AbstractWidget
{
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
     * Widget type name - defaults to a class name, but can be overloaded
     *
     * @var string
     */
    protected $widgetTypeName;

    /**
     * Threshold values for this metric
     *
     * @var array
     */
    protected $threshold = array();

    /**
     * Constructor
     *
     * @param array $params Merged parameters from custom and default widget config
     */
    public function __construct(array $params)
    {
        $this->params = $params;

        $this->setWidgetTypeName($this->getClassName());
    }

    /**
     * Returns data for a metric specified in the rtm config.
     *
     * This method is called mainly by LongPollingController within "get" method.
     * In this way we can update state of each widget using daos connected with them.
     *
     * @return mixed
     */
    public function fetchData()
    {
        $methodName = 'fetch' . ucfirst($this->getParam('metric')) . 'For' . $this->getWidgetTypeName();

        $response = $this->getDao()->$methodName($this->params);
        $this->setResponseHash($response);

        return $response;
    }

    /**
     * Returns widget specific parameter
     *
     * @param  string $paramName Parameter name.
     * @return mixed  Value of a provided parameter name or null if the parameter is not specified.
     */
    public function getParam($paramName)
    {
        if (isset($this->params[$paramName])) {
            return $this->params[$paramName];
        } else {
            return null;
        }
    }

    /**
     * Sets a param for a specific widget
     *
     * @param string $paramName parameter name
     * @param mixed $value parameter value
     * @return $this
     */
    public function setParam($paramName, $value)
    {
        $this->params[$paramName] = $value;

        return $this;
    }

    /**
     * Prepares response hash using sha1 algorithm
     *
     * @param array $responseHash Array of response values
     */
    public function setResponseHash($responseHash)
    {
        $hash = sha1(serialize($responseHash));
        $this->responseHash = $hash;
    }

    /**
     * Returns response hash prepared from metric values
     *
     * @return mixed
     */
    public function getResponseHash()
    {
        return $this->responseHash;
    }

    /**
     * Returns template name of a widget
     *
     * @return ViewModel
     */
    public function getTplName()
    {
        $tplName = $this->getParam('tplName');

        if (is_null($tplName)) {
            $tplName = $this->prepareTplName();
        }
        $tplName = 'dashboard/dashboard/widget/' . strtolower($tplName) . '.phtml';

        return $tplName;
    }

    /**
     * Returns template name
     *
     * If a template name is not specified as a widget's param
     * it is auto created from widget type name
     * (Note: each word of the widget type name will be separated with a dash ('-').
     *
     * @return string
     */
    protected function prepareTplName()
    {
        // We're separating each word of a widget class name using a dash (‘-‘).
        $inflector = new Inflector(':tplName');
        $inflector->setRules(array(
            ':tplName' => array('Word\CamelCaseToDash')
        ));

        $className = $this->getWidgetTypeName();

        $tplName = $inflector->filter(array('tplName' => $className));

        return $tplName;
    }

    /**
     * Returns name of the class without namespace
     *
     * @return string
     */
    public function getClassName()
    {
        $class = explode('\\', get_class($this));

        return end($class);
    }

    /**
     * Sets widget's dao
     *
     * @param AbstractDao $dao Concrete dao object
     */
    public function setDao(AbstractDao $dao)
    {
        $this->dao = $dao;
    }

    /**
     * Returns dao
     *
     * @return mixed
     */
    public function getDao()
    {
        return $this->dao;
    }

    /**
     * Sets widget identifier
     *
     * @param mixed $id Widget identifier
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Returns widget identifier
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns array of widget's parameters
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Cache identifier setter
     *
     * @param string $cacheIdentifier string index key
     */
    public function setCacheIdentifier($cacheIdentifier)
    {
        $this->params['cacheIdentifier'] = $cacheIdentifier;
    }

    /**
     * Cache identifier getter
     *
     * @return string
     */
    public function getCacheIdentifier()
    {
        return $this->params['cacheIdentifier'];
    }

    /**
     * Set widget type name
     *
     * @param string $widgetTypeName Widget type name
     */
    public function setWidgetTypeName($widgetTypeName)
    {
        $this->widgetTypeName = $widgetTypeName;
    }

    /**
     * Get widget type name
     *
     * @return string
     */
    public function getWidgetTypeName()
    {
        return $this->widgetTypeName;
    }

    /**
     * Set threshold values.
     * To be extended if necessary.
     */
    public function setThreshold()
    {
        if (method_exists($this->getDao(), 'fetchThreshold')) {
            $this->threshold = $this->getDao()->fetchThreshold($this->getParams());
        }
    }

    /**
     * Returns metrics threshold values
     * @return array
     */
    public function getThreshold()
    {
        return $this->threshold;
    }
}
