<?php
/**
 *
 * @author Konrad Turczynski <konrad.turczynski@schibsted.pl>
 */
namespace Dashboard\Model\Widget;

class ErrorWidget extends NumberWithNewRelicThresholdWidget {
    public function __construct(array $params) {
        parent::__construct($params);

        $this->setWidgetTypeName('ErrorWidget');
    }
}
