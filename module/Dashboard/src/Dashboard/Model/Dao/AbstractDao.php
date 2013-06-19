<?php
/**
 * Abstract DAO class to be extended by all other DAOs
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Model\Dao;


use Dashboard\Model\Dao\Exception\EndpointUrlNotAssembled;
use Dashboard\Model\Dao\Exception\EndpointUrlNotDefined;
use Dashboard\Model\Dao\Exception\FetchNotImplemented;
use Zend\Http\Client;
use Zend\Http\Exception\InvalidArgumentException;
use Zend\Http\Request;
use Zend\Json\Json;

abstract class AbstractDao {
    /**
     * Request returns XML
     *
     * @var string
     */
    const RESPONSE_IN_XML = 'xml';

    /**
     * Requests returns JSON
     *
     * @var string
     */
    const RESPONSE_IN_JSON = 'json';

    /**
     * Data provider object, may be overloaded
     *
     * @var \Zend\Http\Client
     */
    protected $dataProvider;

    /**
     * Dao configuration e.g. list of available endpoints
     *
     * @var array
     */
    protected $config;

    /**
     * Dao usage options e.g. accountId, optional headers
     * required while performing every request through AbstractDao::dataProvider
     *
     * @var array
     */
    protected $daoOptions;

    /**
     * Cache adapter that can be used with this DAO
     *
     * @var \Zend\Cache\Storage\Adapter\AbstractAdapter
     */
    protected $cacheAdapter;

    /**
     * Dao constructor
     * Data provider can be injected, otherwise we use \Zend\Http\Client
     * @param array $config Dao configuration
     * @param object $dataProvider data provider object
     * @param \Zend\Cache\Storage\Adapter\AbstractAdapter $cacheAdapter cache adapter used with this DAO
     */
    public function __construct($config, $dataProvider = null, $cacheAdapter = null) {
        $this->config = $config;

        if (is_null($dataProvider)) {
            $dataProvider = $this->setDefaultDataProvider();
        }

        $this->setDataProvider($dataProvider);
        $this->setCacheAdapter($cacheAdapter);
    }

    /**
     * Creates a dataProvider object (\Zend\Http\Client)
     * @return Client
     */
    protected function setDefaultDataProvider() {
        $dataProvider = new Client();

        $adapter = new Client\Adapter\Curl();
        $adapter->setOptions(array(
            'curloptions' => array(
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => 0,
            )
        ));

        $dataProvider->setAdapter($adapter);

        $dataProvider->setOptions(array(
            'maxredirects' => 1,
            'timeout'      => 30
        ));

        return $dataProvider;
    }

    /**
     * Configures Dao instance for performing requests
     * @param array $daoOptions - Dao usage parameters e.g. accountId, optional headers
     * @return $this
     */
    public function setDaoOptions(array $daoOptions) {
        $this->daoOptions = $daoOptions;

        return $this;
    }

    /**
     * Returns ONLY URL parameters from self::$daoOptions
     * @return array
     */
    public function getDaoParams() {
        return isset($this->daoOptions['params']) ? $this->daoOptions['params'] : array();
    }

    /**
     * Returns ONLY Http headers from self::$daoOptions
     * @return array
     */
    public function getDaoHeaders() {
        return isset($this->daoOptions['headers']) ? $this->daoOptions['headers'] : array();
    }

    /**
     * Executes a request to a given URL using injected Data Provider
     * @param string|\Zend\Uri\HttpUri $url endpoint destination URL
     * @param array|null $params request params values
     * @param int $responseFormat Format of the response - needed to execute a proper parser
     * @return mixed
     * @throws \Zend\Http\Client\Exception\RuntimeException
     */
    public function request($url, $params = array(), $responseFormat = self::RESPONSE_IN_JSON) {
        $request = new Request();
        $request->setUri($this->assembleUrl($url, $params));

        $client = $this->getDataProvider();

        $headers = $request->getHeaders();
        $headers->addHeaders($this->getDaoHeaders());

        /**
         * @var \Zend\Http\Response
         */
        $response = $client->dispatch($request);

        if ($response->isSuccess()) {
            switch ($responseFormat) {
                case self::RESPONSE_IN_JSON:
                    $responseParsed = Json::decode($response->getBody(), Json::TYPE_ARRAY);
                    break;
                case self::RESPONSE_IN_XML:
                    try {
                        $responseParsed = simplexml_load_string($response->getBody());
                    } catch (Exception $e) {
                        throw new Client\Exception\RuntimeException('Parsing XML from request response failed');
                    }
                    break;
                default:
                    throw new Client\Exception\RuntimeException('Parser for request response not found.');
                    break;
            }
            return $responseParsed;
        } else {
            throw new Client\Exception\RuntimeException('Request failed with status: ' . $response->renderStatusLine() . ' ' . $response->getBody());
        }
    }

    /**
     * Data provider setter
     * @param \Zend\Http\Client $dataProvider data provider object
     */
    public function setDataProvider($dataProvider) {
        $this->dataProvider = $dataProvider;
    }

    /**
     * Data provider getter
     * @return \Zend\Http\Client
     */
    public function getDataProvider() {
        return $this->dataProvider;
    }

    /**
     * Returns endpoint URL associated with a supplied method name.
     * Throws an exception if no URL found.
     * @param string $methodName name of method used for fetching data
     * @return string
     * @throws Exception\EndpointUrlNotDefined
     */
    protected function getEndpointUrl($methodName) {
        if (!isset($this->config['urls'][$methodName])) {
            throw new EndpointUrlNotDefined('Endpoint URL for method "' . $methodName . '" is not defined in ' . get_class($this));
        }

        return $this->config['urls'][$methodName];
    }

    /**
     * Parses given endpoint URL and replaces all placeholders with their corresponding value
     * @param string $url - bare URL with placeholders
     * @param array|null $params - array with optional parameter values
     * @throws Exception\EndpointUrlNotAssembled
     * @return mixed
     */
    protected function assembleUrl($url, $params = array()) {
        /**
         * Merging parameters common for all dashboard widget and widget-specific
         */
        $params = array_merge($this->getDaoParams(), $params);

        $this->validateUrlParamValues($url, $params);

        foreach ($params as $key => $value) {
            $url = str_replace(':' . $key . ':', $value, $url);
        }

        return $url;
    }

    /**
     * Checks if all placeholders in $url have their corresponding values in $params
     * @param string $url - bare URL with placeholders
     * @param array $params - array with optional parameter values
     * @throws Exception\EndpointUrlNotAssembled
     */
    protected function validateUrlParamValues($url, $params) {
        preg_match_all('/\:[\w]+\:/', $url, $matches);

        if (isset($matches[0]) && is_array($matches[0])) {
            foreach ($matches[0] as $placeholderName) {
                if (!isset($params[str_replace(':', '', $placeholderName)])) {
                    throw new EndpointUrlNotAssembled('Endpoint URL cannot be assembled - not all required params were given (missing ' . $placeholderName . ')');
                }
            }
        }
    }

    /**
     * Setter for cache adapter to be used with this DAO
     * @param \Zend\Cache\Storage\Adapter\AbstractAdapter $cacheAdapter
     */
    public function setCacheAdapter($cacheAdapter) {
        $this->cacheAdapter = $cacheAdapter;
    }

    /**
     * @return \Zend\Cache\Storage\Adapter\AbstractAdapter
     */
    public function getCacheAdapter() {
        return $this->cacheAdapter;
    }

    /**
     * If method does not exist in DAO class and it starts with 'fetch' prefix,
     * we throw the exception because this method should be handled in a specific DAO.
     * @param string $method Function name
     * @param array $args Method arguments
     * @throws Exception\FetchNotImplemented
     */
    public function __call($method, $args) {
        if (strpos($method, 'fetch') === 0) {
            throw new FetchNotImplemented('Method "' . $method . '" not implemented in ' . get_class($this));
        }
    }
}