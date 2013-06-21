$(document).ready(function () {

    var GraphWidget = (function () {

        var $widgets = $(".GraphWidget");
        var $config = $(".container").data('config-name');
        var urlBase = "/stp-rtm/resources/" + $config + "/";

        var init = function () {
                $.ajaxSetup({
                    dataType: "json",
                    timeout: 100000 });
            },

            startListening = function () {

                init();

                $widgets.each(function () {

                    var oldValueHash = '';
                    var nodeName = this.id;
                    var widgetNode = $(this);
                    var valueField = widgetNode.find('.value');

                    (function poll() {
                        $.ajax({
                            complete: poll,
                            url: urlBase + nodeName + oldValueHash,
                            success: function (response) {
                                oldValueHash = "/" + response.hash;
                                valueField.text(response.data[response.data.length - 1].y + valueField.attr('data-sufix'));

                                updateDiff(response, widgetNode);

                            }
                        });
                    })();
                });
            },

            /**
             * Updates field with difference info
             */
              updateDiff = function (response, widgetNode) {

                var oldValue = widgetNode.data("oldValue");

                console.log(oldValue, $.isNumeric(oldValue), response.data[response.data.length - 1].y, $.isNumeric(response.data[response.data.length - 1].y));

                if ($.isNumeric(oldValue) && $.isNumeric(response.data[response.data.length - 1].y)) {
                    var currentValue = response.data[response.data.length - 1].y;
                    var diff = currentValue - oldValue;

                    var percentageDiff = Math.round(Math.abs(diff) / oldValue * 100) + "%";

                    widgetNode.find(".difference").text(percentageDiff + " (" + oldValue + ") ");
                    widgetNode.find(".change-rate").show();

                    if (diff > 0) {
                        widgetNode.find("i").attr("class", "icon-arrow-up");
                    } else {
                        widgetNode.find("i").attr("class", "icon-arrow-down");
                    }
                } else {
                    $(widgetNode).find(".change-rate").hide();
                }

                $('.graph, .y_axis', widgetNode).empty();

                var graph = new Rickshaw.Graph( {
                    element: $('.graph', widgetNode).get(0),
                    width: 275,
                    height: 200,
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
                    orientation: 'left',
                    tickFormat: Rickshaw.Fixtures.Number.formatKMBT,
                    element: $('.y_axis', widgetNode).get(0)
                } );

                y_axis.render();

//                $('.message:not(.hide)').remove();

//                $(response.data).each(function(){
//                    var newMessage = $('.message.hide', widgetNode).clone();
//                    newMessage.find('.createdAt').html(this.createdAt);
//                    newMessage.find('.content').html(this.content);
//                    newMessage.removeClass('hide');
//                    newMessage.insertAfter($('.message:last', widgetNode));
//                });

                widgetNode.data("oldValue", response.data[response.data.length - 1].y);
            };

        return {
            startListening: startListening
        };
    })();

    GraphWidget.startListening();
});