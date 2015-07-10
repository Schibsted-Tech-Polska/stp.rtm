/*global Widget */

function GraphWidget(widget, configName) {

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

GraphWidget.prototype = new Widget();
GraphWidget.prototype.constructor = GraphWidget;

$.extend(GraphWidget.prototype, {
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
        if (response.data.length) {
            var currentValue = response.data[response.data.length - 1].y;
        } else {
            var currentValue = 0;
        }

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

        var zones = [];


        if (parseFloat(this.$widget.attr('data-threshold-caution-value')) > 0
            && parseFloat(this.$widget.attr('data-threshold-critical-value')) > 0) {
            zones = [
                {
                    value: this.$widget.attr('data-threshold-caution-value')
                }, {
                    value: this.$widget.attr('data-threshold-critical-value'),
                    fillColor: '#fff46b',
                    color: '#fffda6'
                }, {
                    fillColor: '#e62a34',
                    color: '#f03542'
                }
            ];
        }

        this.chart = $('.graph', this.widget).highcharts({
            chart: {
                type: 'area'
            },
            title: {
                text: ''
            },
            xAxis: {
                title: '',
                type: 'datetime',
                tickPixelInterval: 150
            },
            yAxis: {
                title: ''
            },
            tooltip: {
                pointFormat: 'Value of <b>{point.y}</b> noted.'
            },
            plotOptions: {
                area: {
                    pointStart: 1940,
                    marker: {
                        enabled: false,
                        symbol: 'circle',
                        radius: 2,
                        states: {
                            hover: {
                                enabled: true
                            }
                        }
                    }
                }
            },
            legend: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            series: [
                {
                    title: {
                        text: ''
                    },
                    data: response.data,
                    zoneAxis: 'y',
                    zones: zones
                }
            ]
        });
        this.checkThresholds(currentValue);
    }
});
