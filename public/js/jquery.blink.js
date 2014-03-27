// Source: http://www.antiyes.com/jquery-blink-plugin
// http://www.antiyes.com/jquery-blink/jquery-blink.js
// MODIFIED
(function($) {
    $.fn.blink = function(options) {
        var defaults = {
            delay: 500,
            opacity: 0
        };
        var options = $.extend(defaults, options);

        return this.each(function() {
            var obj = $(this);
            obj.data('blinkHandle', setInterval(function() {
                if (obj.data("blinkState") == "visible") {
                    obj
                        .css('opacity', options.opacity)
                        .data("blinkState", "hidden");
                }
                else {
                    obj
                        .css('opacity', 1)
                        .data("blinkState", "visible");
                }
            }, options.delay));
        });
    };

    $.fn.blinkStop = function() {
        var obj = $(this);
        clearInterval(obj.data('blinkHandle'));
        obj.css('opacity', 1);
    }
}(jQuery));
