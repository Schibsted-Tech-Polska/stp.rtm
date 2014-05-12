<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Model\Dao\Exception;

/**
 * Class EventTypeNotDefined
 * Throw when someone tries to add event of type that does not have
 * corresponding Document class defined.
 *
 * @package Dashboard\Model\Dao\Exception
 */
class EventTypeNotDefined extends \Exception
{
}
