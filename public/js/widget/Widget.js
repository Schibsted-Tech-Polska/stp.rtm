/*global baseUrl,_ */

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
    this.urlBase = baseUrl + "resources";
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

        this.params = this.$widget.data('params');
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

        this.fetchData();
    },

    fetchData: function () {
        var resp = $.ajax({
            dataType: "json",
            url: this.urlBase + this.configName + this.widgetId + this.oldValueHash
        });

        resp.success(this.fetchDataOnSuccess.bind(this));
        resp.error(this.fetchDataOnError.bind(this));

        resp.onreadystatechange = null;
        resp.abort = null;
        resp = null;
    },

    fetchDataOnSuccess: function (response) {
        setTimeout(function () {
            this.fetchData();
        }.bind(this), this.refreshRandomizer(this.params.refreshRate));

        if (response.hash === undefined) {
            throw new Error('Widget ' + this.widgetId + ' did not return value hash');
        }

        this.$widget.css('opacity', '1');

        if (this.oldValueHash !== "/" + response.hash || this.oldValueHash === '') {
            this.oldValueHash = "/" + response.hash;
            this.handleResponse(response);
        }
    },

    fetchDataOnError: function (jqXHR) {
        /**
         * Scheduling next request for 10 times the normal refreshRate
         * to minimize the number of failed requests.
         */
        setTimeout(function () {
            this.fetchData();
        }.bind(this), this.refreshRandomizer(this.params.refreshRate));

        var response = $.parseJSON(jqXHR.responseText).error;

        this.$widget.css('opacity', '0.2');

        throw new Error(response.message + " (type: " + response.type + ")");
    },

    /**
     * Prepares values to bind for percentage difference
     *
     * @param {number} oldValue
     * @param {number} newValue
     * @returns {object}
     */
    setDifference: function (oldValue, newValue) {

        var dataToBind = {},
            diff,
            percentageDiff;

        if ($.isNumeric(oldValue) && oldValue > 0 && $.isNumeric(newValue)) {

            diff = newValue - oldValue;
            percentageDiff = Math.round(Math.abs(diff) / oldValue * 100);

            dataToBind.oldValue = oldValue;

            if (percentageDiff > 0) {
                dataToBind.percentageDiff = percentageDiff;
            }

            if (diff > 0) {
                dataToBind.arrowClass = "icon-arrow-up";
            } else {
                dataToBind.arrowClass = "icon-arrow-down";
            }

            dataToBind.trend = ((this.params.thresholdComparator == 'higherIsBetter') ? ((diff >= 0) ? 'better' : 'worse') : ((diff <= 0) ? 'better' : 'worse'));
        }

        return dataToBind;
    },
    /**
     * An abstract method invoked after each response from long polling server
     */
    handleResponse: function () {
        throw new Error('Method "handleResponse" must be implemented by concrete widget constructors');
    },

    checkThresholds: function (currentValue) {
        this.$widget.removeClass('thresholdCautionValue').removeClass('thresholdCriticalValue');

        if (typeof(this.params.thresholdComparator) !== 'undefined') {
            if (this.params.thresholdComparator === 'lowerIsBetter') {
                if (this.$widget.attr('data-threshold-critical-value') && currentValue >= this.$widget.attr('data-threshold-critical-value')) {
                    this.$widget.addClass('thresholdCriticalValue');
                } else if (this.$widget.attr('data-threshold-caution-value') && currentValue >= this.$widget.attr('data-threshold-caution-value')) {
                    this.$widget.addClass('thresholdCautionValue');
                }
            }
            else {
                if (this.$widget.attr('data-threshold-critical-value') && currentValue < this.$widget.attr('data-threshold-critical-value')) {
                    this.$widget.addClass('thresholdCriticalValue');
                } else if (this.$widget.attr('data-threshold-caution-value') && currentValue < this.$widget.attr('data-threshold-caution-value')) {
                    this.$widget.addClass('thresholdCautionValue');
                }
            }
        }
    },

    // Return refresh randomizer
    refreshRandomizer: function (refreshRate) {
        var randomizer = refreshRate;
        // Add from 0 to 9 seconds
        randomizer += Math.random() * 10;
        // Use integer value of miliseconds
        randomizer = Math.floor(randomizer * 1000);

        return randomizer;
    },
    animateNumber: function (el, start, end) {
        if (!$.isNumeric(start) || !$.isNumeric(end)) {
            return;
        }

        start = this.isInteger(start) ? parseInt(start, 10) : parseFloat(start);
        end = this.isInteger(end) ? parseInt(end, 10) : parseFloat(end);
        var precission = end % 1 === 0 ? 0 : 1;

        $({value: start}).animate({value: end}, {
            duration: 1000,
            easing: 'swing',
            step: function () {
                el.text(this.value.toFixed(precission));
            }
        });
    },

    isInteger: function (number) {
        return parseFloat(number) == parseInt(number, 10);
    }
};
