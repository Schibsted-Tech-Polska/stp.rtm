$(document).ready(function () {

    var MessagesWidget = (function () {

        var $widgets = $(".MessagesWidget");
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

                $('.message:not(.hide)').remove();

                $(response.data).each(function(){
                    var newMessage = $('.message.hide', widgetNode).clone();
                    newMessage.find('.createdAt').html(this.createdAt);
                    newMessage.find('.content').html(this.content);
                    newMessage.removeClass('hide');
                    newMessage.insertAfter($('.message:last', widgetNode));
                });

                widgetNode.data("oldValue", response.data);
            };

        return {
            startListening: startListening
        };
    })();

    MessagesWidget.startListening();
});