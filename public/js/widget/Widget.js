/**
 * Base widget
 *
 * @constructor
 */
function Widget() {
    this.urlBase = "/stp-rtm/resources";
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
        this.refreshRate = this.$widget.attr('data-refresh-rate');
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