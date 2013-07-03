<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Model\Dao\Exception;

/**
 * Class FetchNotImplemented
 * Fetch method for a desired metric is not available in chosen DAO.
 *
 * @package Dashboard\Model\Dao\Exception
 */
class FetchNotImplemented extends \Exception {}