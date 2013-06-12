<?php
/**
 * Abstract DAO class to be extended by all other DAOs
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Model\Dao;


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
     * Dao constructor
     * Data provider can be injected, otherwise we use \Zend\Http\Client
     * @param StdClass $dataProvider data provider object
     */
    public function __construct($dataProvider = null) {
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
     * @param string|\Zend\Uri\HttpUri $url
     * @param int $hydration
     * @return mixed
     * @throws \Zend\Http\Client\Exception\RuntimeException
     */
    public function request($url, $hydration = Json::TYPE_ARRAY) {
        $request = new Request();
        $request->setUri($url);

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
}