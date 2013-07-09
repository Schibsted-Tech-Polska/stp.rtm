/*global Widget */

function MessagesWidget(widget, configName) {

    this.widget = widget;
    this.configName = configName;

    this.dataToBind = {
        'value': '',
        'avatar': ''
    };
}

MessagesWidget.prototype = new Widget();
MessagesWidget.prototype.constructor = MessagesWidget;

$.extend(MessagesWidget.prototype, {
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