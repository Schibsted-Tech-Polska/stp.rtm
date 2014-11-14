/*global Widget */

function UsageWidget(widget, configName) {

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

UsageWidget.prototype = new Widget();
UsageWidget.prototype.constructor = UsageWidget;

$.extend(UsageWidget.prototype, {
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
        var currentValue = response.data.current_value;

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
                type: 'solidgauge'
            },
            title: null,
            pane: {
                size: '120%',
                startAngle: -90,
                endAngle: 90,
                background: {
                    backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
                    innerRadius: '60%',
                    outerRadius: '100%',
                    shape: 'arc'
                }
            },

            tooltip: {
                enabled: false
            },
            // the value axis
            yAxis: {
                stops: [
                    [0, '#70C536'], // green
                    [0.5, '#FFF46B'], // yellow
                    [0.75, '#ED303C'] // red
                ],
                lineWidth: 0,
                minorTickInterval: null,
                tickPixelInterval: 400,
                tickWidth: 0,
                title: {
                    y: -70
                },
                labels: {
                    y: 16
                },
                min: response.data.minimum_value,
                max: response.data.maximum_value
            },

            plotOptions: {
                solidgauge: {
                    dataLabels: {
                        y: 5,
                        borderWidth: 0,
                        useHTML: true
                    }
                }
            },

            credits: {
                enabled: false
            },

            series: [{
                //data: [response.data.mem_used],
                data: [response.data.current_value],
                dataLabels: false,
                tooltip: false
            }]
        });

        this.checkThresholds(currentValue);
    }
});
