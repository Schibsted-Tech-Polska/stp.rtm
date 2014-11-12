/*global Widget */

function RabbitMemoryWidget(widget, configName) {

    this.widget = widget;
    this.configName = configName;
    this.chart = null;
    this.oldValue = 0;

    this.dataToBind = {
        'value': '',
        'arrowClass': '',
        'percentageDiff': 0,
        'oldValue': ''
    };
}

RabbitMemoryWidget.prototype = new Widget();
RabbitMemoryWidget.prototype.constructor = RabbitMemoryWidget;

$.extend(RabbitMemoryWidget.prototype, {
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
        var data = [];

        $.each(response.data.memory, function(key, value) {
            if (key != 'total') {
                data.push([key, value]);
            }
        });

        var currentValue = response.data.memory.total;

        /**
         * Calculating diff from last collected value
         */
        $.extend(this.dataToBind, this.setDifference(this.oldValue, currentValue));

        this.dataToBind.value = currentValue;

        this.renderTemplate(this.dataToBind);
        this.animateNumber(this.$widget.find('.mainValue'),this.oldValue, currentValue);
        this.oldValue = currentValue;

        if (this.chart !== null) {
            this.chart.highcharts().destroy();
        }

        this.chart = $('.graph', this.widget).highcharts({
            chart: {
                type: 'pie',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: 'Value of <b>{point.y}</b> noted.'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        distance: -1,
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'white'
                        }
                    },
                    size: '100%',
                    showInLegend: false
                }
            },
            series: [{
                type: 'pie',
                name: 'Memory usage',
                data: data
            }]
        });
    }
});
