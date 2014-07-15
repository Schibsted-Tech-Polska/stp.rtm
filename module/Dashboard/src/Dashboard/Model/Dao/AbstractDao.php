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
use Zend\Http\Request;
use Zend\Json\Json;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

abstract class AbstractDao implements ServiceLocatorAwareInterface
{
    /**
     * Service locator
     *
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

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
     * Requests returns XML acquired from HTML
     *
     * @var string
     */
    const RESPONSE_IN_HTML = 'html';

    /**
     * Requests returns data as is, without any processing
     *
     * @var string
     */
    const RESPONSE_AS_IS = 'plain';

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
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator Service locator interface.
     * @return $this
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;

        return $this;
    }

    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * Dao constructor
     * Data provider can be injected, otherwise we use \Zend\Http\Client
     * @param array $config Dao configuration
     * @param object $dataProvider data provider object
     */
    public function __construct($config, $dataProvider = null)
    {
        $this->config = $config;

        if (is_null($dataProvider)) {
            $dataProvider = $this->setDefaultDataProvider();
        }

        $this->setDataProvider($dataProvider);
    }

    /**
     * Creates a dataProvider object (\Zend\Http\Client)
     *
     * @param  string|null $auth Auth data login:password
     * @return Client
     */
    protected function setDefaultDataProvider($auth = null)
    {
        $dataProvider = new Client();

        $adapter = new Client\Adapter\Curl();

        $curlOptions = array(
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
        );

        // Auth option
        if ($auth) {
            $curlOptions[CURLOPT_USERPWD] = $auth;
        }

        $adapter->setOptions(array(
            'curloptions' => $curlOptions
        ));

        $dataProvider->setAdapter($adapter);

        $dataProvider->setOptions(array(
            'maxredirects' => 1,
            'timeout' => 30
        ));

        return $dataProvider;
    }

    /**
     * Configures Dao instance for performing requests
     * @param array $daoOptions - Dao usage parameters e.g. accountId, optional headers
     * @return $this
     */
    public function setDaoOptions(array $daoOptions)
    {
        $this->daoOptions = $daoOptions;

        return $this;
    }

    /**
     * Returns ONLY URL parameters from self::$daoOptions
     * @return array
     */
    public function getDaoParams()
    {
        return isset($this->daoOptions['params']) ? $this->daoOptions['params'] : array();
    }

    /**
     * Returns ONLY Http headers from self::$daoOptions
     * @return array
     */
    public function getDaoHeaders()
    {
        return isset($this->daoOptions['headers']) ? $this->daoOptions['headers'] : array();
    }

    /**
     * Returns ONLY Auth data from self::$daoOptions
     * @return array
     */
    public function getDaoAuth()
    {
        return isset($this->daoOptions['auth']) ? $this->daoOptions['auth'] : null;
    }

    /**
     * Executes a request to a given URL using injected Data Provider
     *
     * @param  string|\Zend\Uri\HttpUri $url endpoint destination URL
     * @param  array|null $params request params values
     * @param  int $responseFormat Format of the response - needed to execute a proper parser
     * @param  string|null $auth Auth data login:password
     * @param  array|null $postData POST data
     * @return mixed
     * @throws \Zend\Http\Client\Exception\RuntimeException
     */
    public function request(
        $url,
        $params = array(),
        $responseFormat = self::RESPONSE_IN_JSON,
        $auth = null,
        $postData = null
    ) {
        $request = new Request();
        $request->setUri($this->assembleUrl($url, $params));

        // Auth data
        if ($auth && !$this->getDataProvider()->getAdapter() instanceof \Zend\Http\Client\Adapter\Test) {
            $this->setDataProvider($this->setDefaultDataProvider($auth));
        }

        // Use POST method
        if ($postData) {
            $request->setMethod('POST');
            $request->setContent(http_build_query($postData));
        }

        $client = $this->getDataProvider();

        if (!is_null($this->getDaoAuth())) {
            $client->setAuth($this->getDaoAuth()['username'], $this->getDaoAuth()['password'], Client::AUTH_BASIC);
        }

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
                case self::RESPONSE_IN_HTML:
                    try {
                        // load as HTML, supress any error and pass it to XML parser
                        $doc = new \DOMDocument();
                        $doc->recover = true;
                        $doc->strictErrorChecking = false;
                        @$doc->loadHTML($response->getBody());
                        $responseParsed = simplexml_load_string($doc->saveXML());
                    } catch (Exception $e) {
                        throw new Client\Exception\RuntimeException('Parsing XML from request response failed');
                    }
                    break;
                case self::RESPONSE_AS_IS:
                    $responseParsed = $response;
                    break;
                default:
                    throw new Client\Exception\RuntimeException('Parser for request response not found.');
                    break;
            }

            return $responseParsed;
        } else {
            throw new Client\Exception\RuntimeException(
                'Request failed with status: '
                . $response->renderStatusLine()
                . ' ' . $response->getBody(),
                $response->getStatusCode()
            );
        }
    }

    /**
     * Data provider setter
     * @param \Zend\Http\Client $dataProvider data provider object
     */
    public function setDataProvider($dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * Data provider getter
     * @return \Zend\Http\Client
     */
    public function getDataProvider()
    {
        return $this->dataProvider;
    }

    /**
     * Returns endpoint URL associated with a supplied method name.
     * Throws an exception if no URL found.
     * @param  string $methodName name of method used for fetching data
     * @return string
     * @throws Exception\EndpointUrlNotDefined
     */
    protected function getEndpointUrl($methodName)
    {
        if (!isset($this->config['urls'][$methodName])) {
            throw new EndpointUrlNotDefined(
                'Endpoint URL for method "'
                . $methodName
                . '" is not defined in '
                . get_class($this)
            );
        }

        return $this->config['urls'][$methodName];
    }

    /**
     * Parses given endpoint URL and replaces all placeholders with their corresponding value
     * @param  string $url - bare URL with placeholders
     * @param  array|null $params - array with optional parameter values
     * @throws Exception\EndpointUrlNotAssembled
     * @return mixed
     */
    protected function assembleUrl($url, $params = array())
    {
        /**
         * Merging parameters common for all dashboard widget and widget-specific
         */
        $params = array_merge($this->getDaoParams(), $params);

        $this->validateUrlParamValues($url, $params);

        foreach ($params as $key => $value) {
            if (!is_array($value)) {
                $url = str_replace(':' . $key . ':', $value, $url);
            }
        }

        return $url;
    }

    /**
     * Checks if all placeholders in $url have their corresponding values in $params
     * @param  string $url - bare URL with placeholders
     * @param  array $params - array with optional parameter values
     * @throws Exception\EndpointUrlNotAssembled
     */
    protected function validateUrlParamValues($url, $params)
    {
        preg_match_all('/\:[\w]+\:/', $url, $matches);

        if (isset($matches[0]) && is_array($matches[0])) {
            foreach ($matches[0] as $placeholderName) {
                if (!isset($params[str_replace(':', '', $placeholderName)])) {
                    throw new EndpointUrlNotAssembled(
                        'Endpoint URL cannot be assembled - not all required params were given (missing '
                        . $placeholderName
                        . ')'
                    );
                }
            }
        }
    }

    /**
     * If method does not exist in DAO class and it starts with 'fetch' prefix,
     * we throw the exception because this method should be handled in a specific DAO.
     * @param  string $method Function name
     * @param  array $args Method arguments
     * @throws Exception\FetchNotImplemented
     */
    public function __call($method, $args)
    {
        if (strpos($method, 'fetch') === 0) {
            throw new FetchNotImplemented(
                sprintf(
                    'Method "%s" not implemented in %s. Executed with %s.',
                    $method,
                    get_class($this),
                    print_r($args, true)
                )
            );
        }
    }
}
