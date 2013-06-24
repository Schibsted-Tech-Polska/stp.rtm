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
        this.refreshRate = this.$widget.attr('data-refresh-rate');
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

        this.init();
        var self = this;

        self.fetchData();
        setInterval(function() {self.fetchData()}, self.refreshRate * 1000);
    },

    fetchData: function() {
        var self = this;

        $.ajax({
            dataType: "json",
            url: self.urlBase + self.configName + self.widgetId + self.oldValueHash
        }).success(function (response) {
                if (response.hash === undefined) {
                    throw 'Widget ' + self.widgetId + ' did not return value hash';
                }

                if (self.oldValueHash != "/" + response.hash || self.oldValueHash == '') {
                    self.oldValueHash = "/" + response.hash;
                    self.handleResponse(response);
                }
            }).error(function (jqXHR, status, errorThrown) {
                var response = $.parseJSON(jqXHR.responseText).error;
                throw new Error(response.message + " (type: " + response.type + ")");
            });
    },

    /**
     * An abstract method invoked after each response from long polling server
     */
    handleResponse: function () {
        throw new Error('Method "handleResponse" must be implemented by concrete widget constructors');
    }
};