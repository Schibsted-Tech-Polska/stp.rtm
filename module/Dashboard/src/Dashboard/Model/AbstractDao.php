<?php
/**
 * Abstract DAO class to be extended by all other DAOs
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Model;


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
     * Prevent direct creation of object.
     *
     * @return void
     * @see    getInstance
     */
    protected function __construct() {
        $client = new Client();
        $client->setOptions(array(
            'maxredirects' => 1,
            'timeout'      => 30
        ));

        $this->setDataProvider($client);
    }

    /**
     * Prevent cloning the instance.
     *
     * @return void
     */
    final private function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    /**
     * Handles static calls to non-static methods in extending classes.
     *
     * For example, class Foo with non-static method bar() can be called
     * statically as <code>Foo::_bar()</code>. Simply prepend the method name
     * with an underscore. If the method name already starts with an underscore,
     * then simply remove it.
     *
     * Triggers an error of level E_USER_ERROR if the method either cannot be
     * called statically, or cannot be found.
     *
     * @param  string $name method name
     * @param  mixed  $args method params
     * @return mixed
     * @link   http://php.net/manual/language.oop5.overloading.php#language.oop5.overloading.methods Method overloading
     */
    public static function __callStatic($name, $args) {
        $object = static::getInstance();
        $method = substr($name, 0, 1) === '_' ? substr($name, 1) : '_' . $name;
        if (!method_exists($object, $method)) {
            trigger_error('Cannot access method ' . get_class($object) . '->' . $name . ' statically', E_USER_ERROR);
        }

        return call_user_func_array(array($object, $method), $args);
    }

    /**
     * Handles non-static calls to static methods in extending classes.
     *
     * For example, class Foo with static method bar() can be called from the
     * object context by prepending the method name with an underscore.
     *
     * For example:
     * <code>
     * $fooObj = Foo::getInstance();
     * $fooObj->_bar();
     * </code>
     *
     * Triggers an error of level E_USER_ERROR if the method either cannot be
     * called statically, or cannot be found.
     *
     * @param  string $name method name
     * @param  mixed  $args method params
     * @return mixed
     * @see    __callStatic
     * @link   http://php.net/manual/language.oop5.overloading.php#language.oop5.overloading.methods Method overloading
     */
    public function __call($name, $args) {
        $class = get_called_class();
        if (!class_exists($class)) {
            trigger_error('Class ' . $class . " doesn't exist", E_USER_ERROR);
        }
        $method = $class . "::" . (substr($name, 0, 1) === "_" ? substr($name, 1) : '_' . $name);
        if (!is_callable($method)) {
            trigger_error($method . ' cannot be called from the object context', E_USER_ERROR);
        }
        return call_user_func_array($method, $args);
    }

    /**
     * Returns (and creates if necessary) the only object instance of this class.
     *
     * Gets a single instance of the class the static method is called in. See the
     * {@link http://php.net/lsb Late Static Bindings} feature for more information.
     *
     * @return object Returns a single instance of the class.
     */
    public static function getInstance() {
        static $instance = null;
        return $instance ? : $instance = new static();
    }

    public function request($url, $hydration = Json::TYPE_ARRAY) {
        $request = new Request();
        $request->setUri($url);

        /**
         * @var \Zend\Http\Response
         */
        $response = $this->getDataProvider()->dispatch($request);

        if ($response->isSuccess()) {
            return Json::decode($response->getBody(), $hydration);
        }
        else {
            throw new Client\Exception\RuntimeException('Request failed with status: ' . $response->renderStatusLine());
        }
    }

}