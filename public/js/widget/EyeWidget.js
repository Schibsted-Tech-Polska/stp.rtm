/*global Widget */

function EyeWidget(widget, configName) {

    this.widget = widget;
    this.configName = configName;

    this.dataToBind = {
        'value': ''
    };
}

EyeWidget.prototype = new Widget();
EyeWidget.prototype.constructor = EyeWidget;

$.extend(EyeWidget.prototype, {
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

        this.oldValue = response.data;

        this.dataToBind.lastUpdate = response.updateTime;

        this.renderTemplate(this.dataToBind);
    }
});
