function GraphWidget(widget, configName) {

    this.widget = widget;
    this.configName = configName

    this.dataToBind = {
        'value': '',
        'arrowClass': '',
        'percentageDiff': '',
        'oldValue': ''
    }
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

        var oldValue = this.oldValue;
        var self = this;

        /**
         * Calculating diff from last collected value
         */

        var currentValue = response.data[response.data.length - 1].y;
        if ($.isNumeric(oldValue) && $.isNumeric(response.data[response.data.length - 1].y)) {
            var diff = currentValue - oldValue;

            var percentageDiff = Math.round(Math.abs(diff) / oldValue * 100);

            this.dataToBind.percentageDiff = percentageDiff;
            this.dataToBind.oldValue = oldValue;

            if (diff > 0) {
                this.dataToBind.arrowClass = "icon-arrow-up";
            } else {
                this.dataToBind.arrowClass = "icon-arrow-down";
            }
        }

        this.dataToBind.value = currentValue;
        this.oldValue = currentValue;

        this.renderTemplate(this.dataToBind);

        /**
         * Graph part of the widget
         */

        $('.graph, .y_axis', this.widget).empty();

        var graph = new Rickshaw.Graph( {
            element: $('.graph', this.widget).get(0),
            width: self.params.graphWidth,
            height: self.params.graphHeight,
            series: [{
                color: 'steelblue',
                data: response.data
            }]
        });

        graph.render();

        var x_axis = new Rickshaw.Graph.Axis.Time( { graph: graph } );

        x_axis.render();

        var y_axis = new Rickshaw.Graph.Axis.Y( {
            graph: graph,
            orientation: 'right',
            tickFormat: Rickshaw.Fixtures.Number.formatKMBT,
            element: $('.y_axis', this.widget).get(0)
        } );

        y_axis.render();

    }
});