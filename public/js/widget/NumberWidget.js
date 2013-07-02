/**
 * Constructor of NumberWidget
 *
 * @param {Object} widget Object representing DOM node of a widget.
 * @param {String} configName Name of a config file.
 * @constructor
 */
function NumberWidget(widget, configName) {

    this.widget = widget;
    this.configName = configName;

    this.dataToBind = {
        'value': '',
        'arrowClass': '',
        'percentageDiff': 0,
        'oldValue': '',
        'lastUpdate': '',
        'thresholdValue': 0
    }
}

NumberWidget.prototype = new Widget();
NumberWidget.prototype.constructor = NumberWidget;

$.extend(NumberWidget.prototype, {
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

        if ($.isNumeric(response.data)) {
            this.dataToBind.value = response.data;
        } else if (typeof(response.data.value) != 'undefined' && $.isNumeric(response.data.value)) {
            this.dataToBind.value = response.data.value;
            this.dataToBind.thresholdValue = response.data.thresholdValue;
        }

        $.extend(this.dataToBind,this.setDifference(this.oldValue, this.dataToBind.value));

        this.oldValue = this.dataToBind.value;

        this.dataToBind.lastUpdate = response.updateTime;

        this.renderTemplate(this.dataToBind);

        this.checkThresholds(this.dataToBind.value);
    }
});
