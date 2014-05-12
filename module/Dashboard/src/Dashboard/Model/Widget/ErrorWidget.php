<?php
/**
 *
 * @author Konrad Turczynski <konrad.turczynski@schibsted.pl>
 */
namespace Dashboard\Model\Widget;

/**
 * Class ErrorWidget
 *
 * @package Dashboard\Model\Widget
 */
class ErrorWidget extends NumberWithNewRelicThresholdWidget
{
    /**
     * Constructor
     *
     * @param array $params Params
     */
    public function __construct(array $params)
    {
        parent::__construct($params);

        $this->setWidgetTypeName('ErrorWidget');
    }
}
