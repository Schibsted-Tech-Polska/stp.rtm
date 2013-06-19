/**
 * Base widget
 *
 * @constructor
 */
function Widget() {
    this.options = {
        'urlBase': "/resources"
    };

    this.oldValueHash = '';
}

/**
 * Common interface for custom widgets
 */
Widget.prototype = {

    init: function () {
        this.configName = "/" + this.options.configName;
        this.widgetId = "/";
    },

    startListening: function () {

        this.init();
        var self = this;

        (function poll() {
            $.ajax({
                dataType: "json",
                timeout: 100000,
                complete: poll,
                url: self.options.urlBase + self.configName + self.widgetId + self.oldValueHash,
                success: function (response) {
                    if(response.hash === undefined) {
                        throw 'Widget ' + self.widgetId + ' did not return value hash';
                    }
                    self.oldValueHash = "/" + response.hash;
                    self.handleResponse(response);
                },
                error: function(jqXHR, status, errorThrown) {
                    console.log(status + " " + errorThrown);
                    return 0;
                }
            });
        })()
    },

    handleResponse: function () {
        throw new Error('Method "handleResponse" must be implemented by concrete widget constructors');
    }
}