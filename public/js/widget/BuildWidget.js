function BuildWidget(widget, configName) {

    this.widget = widget;
    this.configName = configName;

    this.dataToBind = {
        'value': '',
        'currentStatus': '',
        'averageHealthScore': '',
        'lastCommitter': '',
        'lastBuilt': '',
        'percentDone': '',
        'lastStatus': null
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
        if (typeof(this.oldValue) != 'undefined') {
            this.dataToBind.lastStatus = this.oldValue.currentStatus;
        }
        this.dataToBind.averageHealthScore = response.data.averageHealthScore;
        this.dataToBind.lastCommitter = response.data.lastCommitter;
        this.dataToBind.lastBuilt = response.data.lastBuilt;

        this.dataToBind.percentDone = response.data.percentDone;

        if (response.data.averageHealthScore <= 100 && response.data.averageHealthScore > 80) {
            this.dataToBind.averageHealthScoreClass = '1';
        }
        /**
         * Legacy from ruby dashing icons
         */

        else if (response.data.averageHealthScore <= 80 && response.data.averageHealthScore > 60) {
            this.dataToBind.averageHealthScoreClass = '2';
        }
        else if (response.data.averageHealthScore <= 60 && response.data.averageHealthScore > 40) {
            this.dataToBind.averageHealthScoreClass = '3';
        }
        else if (response.data.averageHealthScore <= 40 && response.data.averageHealthScore > 20) {
            this.dataToBind.averageHealthScoreClass = 'k';
        }
        else if (response.data.averageHealthScore <= 20) {
            this.dataToBind.averageHealthScoreClass = 'y';
        }

        this.renderTemplate(this.dataToBind);

        /**
         * Hacks for the flipping effect - totally optional
         */
        if (response.data.currentStatus == 'FAILURE') {
            this.$widget.find('.flip-container').removeClass("flipped-effect");
            this.$widget.find('.progress-bar').hide();
            this.$widget.find('.flip-container').addClass("FAILURE");
        }
        else if (response.data.currentStatus == null) {
            if (!this.$widget.find('.flip-container').hasClass("flipped-effect")) {
                this.$widget.find('.progress-bar').show();
                this.$widget.find('.flip-container').addClass("flipped-effect");
            }
        }
        else if (response.data.currentStatus != null && response.data.currentStatus != 'PREBUILD' && typeof(this.oldValue) != 'undefined' && this.oldValue.currentStatus == null) {
            this.$widget.find('.progress-bar').hide();
            this.$widget.find('.flip-container').removeClass("flipped-effect");
            this.$widget.find('.flip-container').removeClass("building-failure");
        }

        this.$widget.data("oldValue", response.data);


        this.oldValue = response.data;

        meter = this.$widget.find(".jenkins-build");
        meter.knob();
    }
});