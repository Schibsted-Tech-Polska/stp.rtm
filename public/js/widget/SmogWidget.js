/*global Widget */

function SmogWidget(widget, configName) {

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

SmogWidget.prototype = new Widget();
SmogWidget.prototype.constructor = SmogWidget;

$.extend(SmogWidget.prototype, {
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

        this.dataToBind = response;
        this.oldValue = this.dataToBind;

        this.renderTemplate(this.dataToBind);

        if (this.chart !== null) {
            this.chart.highcharts().destroy();
        }

        var source = this.dataToBind.data,
            categories = [],
            colors = [],
            data = [];
            
        for (var i = 0; i < source.length; ++i) {
            var log = Math.log(source[i].percent) / Math.LN10,
                stops = [
                    [0.000, '#73d216'],
                    [0.200, '#579000'],
                    [0.500, '#cc0000'],
                    [1.000, '#000000']
                ],
                y = (Math.min(Math.max(log, -1), 3) + 2) / 5.0;
                        
            for (var j = 1; j < stops.length; ++j) {
                if (stops[j][0] > y) {
                    stops.splice(j + 1, 4);
                    break;
                }
            }
        
            categories.push(source[i].parameter);
            data.push({
                color: {
                    linearGradient: { x1: 0, y1: y, x2: 0, y2: 0 },
                    stops: stops
                },
                y: source[i].percent
            });
        }
        
        this.chart = $('.graph', this.widget).highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            xAxis: {
                categories: categories,
                labels: {
                    style: {
                        color: '#FFFFFF',
                        fontSize: '14px'
                    }
                }
            },
            yAxis: {
                labels: {
                    formatter: function() {
                        return this.value + '%';
                    }
                },
                min: 0.1,
                max: 1000,
                type: 'logarithmic',
                title: ''
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            legend: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            series: [{
                name: 'Norms',
                data: data,
                dataLabels: {
                    enabled: true,
                    color: '#FFFFFF',
                    formatter: function() {
                        return Math.round(this.y) + '%';
                    },
                    shadow: true,
                    style: {
                        fontSize: '14px'
                    }
                }
            }]
        });
    }
});