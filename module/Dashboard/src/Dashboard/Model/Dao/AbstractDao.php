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
     * Data provider object, may be overloaded
     *
     * @var \Zend\Http\Client
     */
    protected $dataProvider;

    /**
     * Dao configuration
     *
     * @var array
     */
    protected $config;

    /**
     * Dao constructor
     * Data provider can be injected, otherwise we use \Zend\Http\Client
     * @param array $config Dao configuration
     * @param StdClass $dataProvider data provider object
     */
    public function __construct($config, $dataProvider = null) {
        $this->config = $config;

        if (is_null($dataProvider)) {
            $dataProvider = new Client();
            $dataProvider->setOptions(array(
                'maxredirects' => 1,
                'timeout'      => 30
            ));
        }

        $this->setDataProvider($dataProvider);
    }

    /**
     * Executes a request to a given URL using injected Data Provider
     * @param string|\Zend\Uri\HttpUri $url endpoint destination URL
     * @param array|null $params request params values
     * @param int $hydration hydration mode for \Zend\Json\Json
     * @return mixed
     * @throws \Zend\Http\Client\Exception\RuntimeException
     */
    public function request($url, $params = null, $hydration = Json::TYPE_ARRAY) {
        $request = new Request();
        $request->setUri($this->assembleUrl($url, $params));

        /**
         * @var \Zend\Http\Response
         */
        $response = $this->getDataProvider()->dispatch($request);

        if ($response->isSuccess()) {
            return Json::decode($response->getBody(), $hydration);
        } else {
            throw new Client\Exception\RuntimeException('Request failed with status: ' . $response->renderStatusLine());
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
    protected function assembleUrl($url, $params = null) {
        if (is_array($params)) {
            foreach ($params as $key => $value) {
                $url = str_replace(':' . $key . ':', $value, $url);
            }
        }

        if (preg_match('/\:[\w]+\:/', $url, $matches) === 1) {
            throw new EndpointUrlNotAssembled('Endpoint URL not assembled - not all required params were given (missing ' . implode(', ', $matches) . ')');
        }

        return $url;
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