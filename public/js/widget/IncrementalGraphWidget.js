/*global Widget */

function IncrementalGraphWidget(widget, configName) {

    this.widget = widget;
    this.configName = configName;
    this.chart = null;

    this.dataToBind = {
        'value': '',
        'arrowClass': '',
        'percentageDiff': 0,
        'oldValue': ''
    };
}

IncrementalGraphWidget.prototype = new Widget();
IncrementalGraphWidget.prototype.constructor = IncrementalGraphWidget;

$.extend(IncrementalGraphWidget.prototype, {
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

        var currentPoint = response.data,
            currentValue = currentPoint.y,
            pointX = parseFloat(currentPoint.x) * 1000,
            pointY = parseFloat(currentPoint.y);


        /**
         * Calculating diff from last collected value
         */
        $.extend(this.dataToBind, this.setDifference(this.oldValue, currentValue));

        this.dataToBind.value = currentValue;
        this.oldValue = currentValue;

        if (this.chart !== null) {
            this.handleChangeRate();
        } else {
            this.renderTemplate(this.dataToBind);
            this.setupGraph();
        }
        this.chart.highcharts().series[0].addPoint([pointX, pointY]);
    },

    handleChangeRate: function() {
        $('.change-rate', this.widget)
            .show()
            .removeClass(['better', 'worse']).addClass(this.dataToBind.trend)
            .find('i')
                .removeClass().addClass(this.dataToBind.arrowClass).parent()
            .find('.percentageDiff')
                .html(this.dataToBind.percentageDiff).parent()
            .find('.old-value')
                .html(this.dataToBind.oldValue);
    },

    setupGraph: function() {
        $('.change-rate', this.widget).hide();
        this.chart = $('.graph', this.widget).highcharts({
            chart: {
                type: 'spline'
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
                    data: []
                }
            ]
        });
    }
});