<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace DashboardTest\Model\Dao;


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
    abstract protected function getTestedDao();

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     */
    protected function setUp()
    {
        $this->testedDao = $this->getTestedDao();
        $this->testedDao->getDataProvider()->setAdapter(new \Zend\Http\Client\Adapter\Test());
    }
}
