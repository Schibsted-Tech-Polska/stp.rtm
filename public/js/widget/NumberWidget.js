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
        'difference': '',
        'lastUpdate': ''
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

        this.dataToBind.value = response.data;

        if ($.isNumeric(this.oldValue) && $.isNumeric(response.data.value)) {
            var diff = response.data - this.oldValue;

            var percentageDiff = Math.round(Math.abs(diff) / this.oldValue * 100) + "%";

            this.dataToBind.difference = percentageDiff + "(" + this.oldValue + ") ";

            if (diff > 0) {
                this.dataToBind.arrowClass = "icon-arrow-up";
            } else {
                this.dataToBind.arrowClass = "icon-arrow-down";
            }
        }

        this.oldValue = response.data;

        this.dataToBind.lastUpdate = response.updateTime;

        this.renderTemplate(this.dataToBind);

        if (this.dataToBind.difference.length > 0) {
            this.$widget.find('.change-rate').show();
        } else {
            this.$widget.find('.change-rate').hide();
        }
    }
});
