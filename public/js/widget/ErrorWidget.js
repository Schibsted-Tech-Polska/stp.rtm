function ErrorWidget(widget, configName) {

    this.widget = widget;
    this.configName = configName;

    this.dataToBind = {
        'value': ''
    }
}

ErrorWidget.prototype = new Widget();
ErrorWidget.prototype.constructor = ErrorWidget;

$.extend(ErrorWidget.prototype, {
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
        if(parseFloat(response.data) > 0) {
            this.$widget.addClass('warning');
        } else {
            this.$widget.removeClass('warning');
        }

        this.oldValue = response.data;

        this.dataToBind.lastUpdate = response.updateTime;

        this.renderTemplate(this.dataToBind);
    }
});
