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
     * Id of the widget
     *
     * @var string
     */
    protected $id = "";
    /**
     * Endpoint string for metric
     *
     * @var string
     */
    protected $endpoint;
    /**
     * Refresh interval (seconds)
     *
     * @var int
     */
    protected $refreshRate;
    /**
     * Api dao
     *
     * @var AbstractDao
     */
    protected $apiDao;
}
