$(document).ready(function () {

    var NumberWidget = (function () {

        var $widgets = $(".NumberWidget");
        var $config = $(".container").data('config-name');
        var urlBase = "/resources/" + $config + "/";

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
                                valueField.text(response.data);

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

                if ($.isNumeric(oldValue) && $.isNumeric(response.data)) {
                    var diff = response.data - oldValue;

                    var percentageDiff = Math.round(Math.abs(diff) / oldValue * 100) + "%";

                    widgetNode.find(".difference").text(percentageDiff + "(" + oldValue + ") ");
                    widgetNode.find(".change-rate").show();

                    if (diff > 0) {
                        widgetNode.find("i").attr("class", "icon-arrow-up");
                    } else {
                        widgetNode.find("i").attr("class", "icon-arrow-down");
                    }
                } else {
                    $(widgetNode).find(".change-rate").hide();
                }

                widgetNode.data("oldValue", response.data);
            };

        return {
            startListening: startListening
        };
    })();

    NumberWidget.startListening();
});