function NumberWidget(widget) {
    this.$widget = $(widget);

    this.options.configName = $('.container').data('config-name');
    this.options.widgetId = this.$widget.attr('id');

    this.valueField = this.$widget.find('.value');
    this.diffContainer = this.$widget.find('.change-rate');
    this.arrowContainer = this.$widget.find('.change-rate i');

}

NumberWidget.prototype = new Widget();
NumberWidget.prototype.constructor = NumberWidget;

$.extend(NumberWidget.prototype, {

    handleResponse: function (response) {

        this.valueField.text(response.data);

        var oldValue = this.$widget.data("oldValue");

        if ($.isNumeric(oldValue) && $.isNumeric(response.data)) {
            var diff = response.data - oldValue;

            var percentageDiff = Math.round(Math.abs(diff) / oldValue * 100) + "%";

            this.$widget.find(".difference").text(percentageDiff + "(" + oldValue + ") ");
            this.$widget.find(".change-rate").show();

            if (diff > 0) {
                this.arrowContainer.attr("class", "icon-arrow-up");
            } else {
                this.arrowContainer.attr("class", "icon-arrow-down");
            }
        } else {
            this.diffContainer.hide();
        }

        this.$widget.data("oldValue", response.data);
    }});

$(document).ready(function () {
    var widget = $("#vgtvCpuUsage");

    $('.NumberWidget').each(function(){
        new NumberWidget(this).startListening();
    });


});