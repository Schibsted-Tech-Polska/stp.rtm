function NumberWidget(widget, configName) {

    this.widget = widget;
    this.configName = configName

    this.dataToBind = {
        'value': '',
        'arrowClass': '',
        'difference': ''
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
     */
    prepareData: function (response) {

        var oldValue = this.oldValue;

        this.dataToBind.value = response.data;

        if ($.isNumeric(oldValue) && $.isNumeric(response.data)) {
            var diff = response.data - oldValue;

            var percentageDiff = Math.round(Math.abs(diff) / oldValue * 100) + "%";

            this.dataToBind.difference = percentageDiff + "(" + oldValue + ") ";

            if (diff > 0) {
                this.dataToBind.arrowClass = "icon-arrow-up";
            } else {
                this.dataToBind.arrowClass = "icon-arrow-down";
            }
        }

        this.oldValue = response.data;

        var date = new Date();
        var hour = date.getHours();
        var min = date.getMinutes();
        this.dataToBind.lastUpdate = this.getFormattedDate();

        this.renderTemplate(this.dataToBind);

        if (this.dataToBind.difference.length > 0) {
            this.$widget.find('.change-rate').show();
        } else {
            this.$widget.find('.change-rate').hide();
        }

    },

    getFormattedDate: function () {
        var date = new Date();
        return date.getFullYear() + "-" + date.getMonth() + "-" + date.getDate() + " " + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
    }
});
