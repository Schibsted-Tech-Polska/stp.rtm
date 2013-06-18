<?php
/**
 *
 * @author Konrad Turczynski <konrad.turczynski@schibsted.pl>
 */
namespace Dashboard\Model\Widget;

class TextWidget extends AbstractWidget {

    /**
     * Returns data for a metric specified in the rtm config
     *
     * @return mixed
     */
    public function fetchData() {
        return array();
    }

    /**
     * Checks whether all required parameters are specified
     * for a concrete type of widget.
     *
     * @return boolean
     */
    function isReadyToRender() {
        // TODO: Implement isReadyToRender() method.
    }
}
