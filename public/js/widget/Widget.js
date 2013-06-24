/**
 * Base widget
 *
 * @constructor
 */
function Widget() {
    /**
     * Url base of a long polling endpoint
     * @property urlBase
     * @type {string}
     */
    this.urlBase = "/resources";
    /**
     * Hash string representing previous values of a response.
     * @property oldValueHash
     * @type {string}
     */
    this.oldValueHash = '';
}

/**
 * Common interface for custom widgets
 */
Widget.prototype = {

    /**
     * Prepares required properties
     */
    init: function () {
        var tpl;

        this.$widget = $(this.widget);
        tpl = $("#" + this.widget.id + "Tpl");
        this.template = tpl.html();
        tpl.remove();

        this.configName = "/" + this.configName;
        this.widgetId = "/" + this.widget.id;
    },

    /**
     * Renders template of a widget
     *
     * @param {Object} dataToBind Data object with all values for placeholders from a template
     */
    renderTemplate: function (dataToBind) {
        if (dataToBind !== undefined) {
            this.$widget.html(_.template(this.template, dataToBind));
        } else {
            this.$widget.html(this.template);
        }
    },

    /**
     * Starts long polling session
     */
    startListening: function () {

        var self = this;
        this.init();

        (function poll() {
            var request = $.ajax({
                dataType: "json",
                timeout: 100000,
                complete: poll,
                url: self.urlBase + self.configName + self.widgetId + self.oldValueHash
            });

            request.done(function (response) {
                if (response.hash === undefined) {
                    throw 'Widget ' + self.widgetId + ' did not return value hash';
                }
                self.oldValueHash = "/" + response.hash;

                self.handleResponse(response);
            });

            request.fail(function (jqXHR, status, errorThrown) {
                var response = $.parseJSON(jqXHR.responseText).error;
                console.log(response.message + " (type: " + response.type + ")");
            });

        })();
    },

    /**
     * An abstract method invoked after each response from long polling server
     */
    handleResponse: function () {
        throw new Error('Method "handleResponse" must be implemented by concrete widget constructors');
    }
};