<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Model\Widget;


class NumberWithNewRelicThresholdWidget extends NumberWidget {

    public function __construct(array $params) {
        parent::__construct($params);

        $this->setWidgetTypeName('NumberWidget');
    }

    public function setThreshold() {
        $this->threshold = $this->getDao()->fetchThreshold($this->getParams());
    }
}