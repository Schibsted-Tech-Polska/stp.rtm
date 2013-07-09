<?php
/**
 * @author: Wojciech Iskra <wojciech.iskra@schibsted.pl>
 */

namespace Dashboard\Model\Widget;

/**
 * Class NumberWithNewRelicThresholdWidget
 *
 * @package Dashboard\Model\Widget
 */
class NumberWithNewRelicThresholdWidget extends NumberWidget {
    /**
     * Constructor
     *
     * @param array $params Params
     */
    public function __construct(array $params) {
        parent::__construct($params);

        $this->setWidgetTypeName('NumberWidget');
    }

    /**
     * Set threshold
     */
    public function setThreshold() {
        $this->threshold = $this->getDao()->fetchThreshold($this->getParams());
    }
}
