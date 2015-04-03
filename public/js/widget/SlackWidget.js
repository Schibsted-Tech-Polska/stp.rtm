/*global Widget */

function SlackWidget(widget, configName) {

    this.widget = widget;
    this.configName = configName;

    this.dataToBind = {
        'value': '',
        'avatar': ''
    };
}

SlackWidget.prototype = new Widget();
SlackWidget.prototype.constructor = SlackWidget;

$.extend(SlackWidget.prototype, {
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
     */
    prepareData: function (response) {

        this.dataToBind.value = response.data;
        this.oldValue = response.data;

        this.renderTemplate(this.dataToBind);
    }
});
