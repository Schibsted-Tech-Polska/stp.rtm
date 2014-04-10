<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Model\Widget;

/**
 * Class GeneralMessagesWidget
 *
 * @package Dashboard\Model\Widget
 */
class GeneralMessagesWidget extends MessagesWidget
{
    /**
     * Constructor
     *
     * @param array $params Params
     */
    public function __construct(array $params)
    {
        parent::__construct($params);

        $this->setWidgetTypeName('MessagesWidget');
    }
}
