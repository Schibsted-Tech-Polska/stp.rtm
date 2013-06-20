function BuildWidget(widget) {
    this.$widget = $(widget);

    this.options.configName = $('.container').data('config-name');
    this.options.widgetId = this.$widget.attr('id');

    this.currentStatus = this.$widget.find('.currentStatus');
    this.averageHealthScore = this.$widget.find('.averageHealthScore');
    this.lastCommitter = this.$widget.find('.lastCommitter');
    this.lastBuilt = this.$widget.find('.lastBuilt');
    this.percentDone = this.$widget.find('.percentDone');
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
        this.updateValue(response);
    },

    /**
     * Updates main valoue
     */
    updateValue: function(response) {

        this.currentStatus.html(response.data.currentStatus);
        this.averageHealthScore.html(response.data.averageHealthScore);
        this.lastCommitter.html(response.data.lastCommitter);
        this.lastBuilt.html(response.data.lastBuilt);
        this.percentDone.html(response.data.percentDone);

        this.$widget.data("oldValue", response.data);
    },
    updateDiff: function() {

    }
});
