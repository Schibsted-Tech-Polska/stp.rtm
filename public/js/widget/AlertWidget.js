/*global Widget */

/**
 * Constructor of AlertWidget
 *
 * @param {Object} widget Object representing DOM node of a widget.
 * @param {String} configName Name of a config file.
 * @constructor
 */
function AlertWidget(widget, configName) {

    this.widget = widget;
    this.configName = configName;

    this.dataToBind = {
        'value': '',
        'arrowClass': '',
        'percentageDiff': 0,
        'oldValue': '',
        'lastUpdate': ''
    };
}

AlertWidget.prototype = new Widget();
AlertWidget.prototype.constructor = AlertWidget;

$.extend(AlertWidget.prototype, {
    /**
     * Invoked after each response from long polling server
     *
     * @param response Response from long polling server
     */
    handleResponse: function (response) {
        this.prepareData(response);
    },

    /**
     * Updates widget's state
     *
     * @param {Object} response Response object from long polling controller
     */
    prepareData: function (response) {

        this.dataToBind.value = response.data;

        $.extend(this.dataToBind, this.setDifference(this.oldValue, this.dataToBind.value));

        this.oldValue = this.dataToBind.value;

        this.dataToBind.lastUpdate = response.updateTime;

        this.renderTemplate(this.dataToBind);
    }
});
