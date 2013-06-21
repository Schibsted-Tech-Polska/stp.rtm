/**
 * Base widget
 *
 * @constructor
 */
function Widget() {
    this.urlBase = "/resources";
    this.oldValueHash = '';
}

/**
 * Common interface for custom widgets
 */
Widget.prototype = {

    init: function () {

        this.$widget = $(this.widget);
        var tpl =  $("#" + this.widget.id + "Tpl");
        this.template = tpl.html();
        tpl.remove();

        this.configName = "/" + this.configName;
        this.widgetId = "/" + this.widget.id;
    },

    /**
     * Renders template of a widget
     *
     * @param dataToBind Data object with all value placeholders from template
     */
    renderTemplate: function (dataToBind) {
        if (dataToBind !== undefined) {
            this.$widget.html(_.template(this.template, dataToBind));
        } else {
            this.$widget.html(this.template);
        }
    },

    /**
     * Starts long polling request
      */
    startListening: function () {

        this.init();
        var self = this;

        (function poll() {
            $.ajax({
                dataType: "json",
                timeout: 100000,
                complete: poll,
                url: self.urlBase + self.configName + self.widgetId + self.oldValueHash
            }).success(function (response) {
                    if (response.hash === undefined) {
                        throw 'Widget ' + self.widgetId + ' did not return value hash';
                    }
                    self.oldValueHash = "/" + response.hash;
                    self.handleResponse(response);
            }).error(function (jqXHR, status, errorThrown) {
                var response = $.parseJSON(jqXHR.responseText).error;
                throw new Error(response.message + " (type: " + response.type + ")");
            });

        })()
    },

    responseSuccess: function (response) {
        if (response.hash === undefined) {
            throw 'Widget ' + self.widgetId + ' did not return value hash';
        }
        self.oldValueHash = "/" + response.hash;
        self.handleResponse(response);
    },

    responseError: function(jqXHR, status, errorThrown) {
        var response = $.parseJSON(jqXHR.responseText).error;
        throw new Error(response.message + " (type: " + response.type + ")");
    },

    handleResponse: function () {
        throw new Error('Method "handleResponse" must be implemented by concrete widget constructors');
    }
};