function BuildWidget(widget, configName) {

    this.widget = widget;
    this.configName = configName

    this.dataToBind = {
        'value': '',
        'currentStatus': '',
        'averageHealthScore': '',
        'lastCommitter': '',
        'lastBuilt': '',
        'percentDone': ''
    }
}

BuildWidget.prototype = new Widget();
BuildWidget.prototype.constructor = BuildWidget;

$.extend(BuildWidget.prototype, {
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

        var oldValue = this.oldValue;

        this.dataToBind.value = response.data;

        this.dataToBind.currentStatus = response.data.currentStatus;
        this.dataToBind.averageHealthScore = response.data.averageHealthScore;
        this.dataToBind.lastCommitter = response.data.lastCommitter;
        this.dataToBind.lastBuilt = response.data.lastBuilt;
        this.dataToBind.percentDone = response.data.percentDone;

        this.$widget.data("oldValue", response.data);


        this.oldValue = response.data;

        this.renderTemplate(this.dataToBind);
    }
});