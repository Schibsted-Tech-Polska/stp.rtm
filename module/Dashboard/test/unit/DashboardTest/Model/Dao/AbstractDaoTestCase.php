<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace DashboardTest\Model\Dao;

use DashboardTest\Bootstrap;

abstract class AbstractDaoTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Dashboard\Model\Dao\AbstractDao $testedDao
     */
    protected $testedDao;

    /**
     * Returns the instance of tested dao
     * @return \Dashboard\Model\Dao\AbstractDao
     */
    protected function getTestedDao() {
        $daoClass = str_replace('Test', '', str_replace(__NAMESPACE__ . '\\', '', get_class($this)));
        return Bootstrap::getServiceManager()->get($daoClass);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     */
    protected function setUp()
    {
        Bootstrap::getServiceManager()->setAllowOverride(true);

        $this->testedDao = $this->getTestedDao();
        $this->testedDao->getDataProvider()->setAdapter(new \Zend\Http\Client\Adapter\Test());
    }
}
