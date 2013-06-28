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

        var paramsJson = this.$widget.attr('data-params');
        if (typeof(paramsJson) == 'undefined') {
            throw new Error('Widget params not passed from PHTML to JS.');
        } else {
            this.params = jQuery.parseJSON(paramsJson);
        }
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
        setInterval(function () {
            self.fetchData()
        }, self.params.refreshRate * 1000);
    },

    fetchData: function () {
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
     * Prepares values to bind for percentage difference
     *
     * @param {number} oldValue
     * @param {number} newValue
     * @returns {object}
     */
    setDifference: function (oldValue, newValue) {

        dataToBind = {};

        if ($.isNumeric(oldValue) && oldValue > 0 && $.isNumeric(newValue)) {

            var diff = newValue - oldValue;

            var percentageDiff = Math.round(Math.abs(diff) / oldValue * 100);

            dataToBind.oldValue = oldValue;

            if(percentageDiff > 0) {
                dataToBind.percentageDiff = percentageDiff;
            }

            if (diff > 0) {
                dataToBind.arrowClass = "icon-arrow-up";
            } else {
                dataToBind.arrowClass = "icon-arrow-down";
            }
        }

        return dataToBind;
    },
    /**
     * An abstract method invoked after each response from long polling server
     */
    handleResponse: function () {
        throw new Error('Method "handleResponse" must be implemented by concrete widget constructors');
    }
};