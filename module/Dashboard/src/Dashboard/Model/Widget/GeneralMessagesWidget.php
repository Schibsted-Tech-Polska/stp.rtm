<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Model\Widget;

class GeneralMessagesWidget extends MessagesWidget {

    public function __construct(array $params) {
        parent::__construct($params);

        $this->setWidgetTypeName('MessagesWidget');
    }
}