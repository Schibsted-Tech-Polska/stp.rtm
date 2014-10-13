/*global Widget */

function HerokuStatusWidget(widget, configName) {

    this.widget = widget;
    this.configName = configName;
    this.oldCodeCoverage = 0;
    this.dataToBind = {
        icon: '',
        className: '',
        message: ''
    };
}

HerokuStatusWidget.prototype = new Widget();
HerokuStatusWidget.prototype.constructor = HerokuStatusWidget;

$.extend(HerokuStatusWidget.prototype, {
    /**
     * Invoked after each response from long polling server
     *
     * @param response Response from long polling server
     */
    handleResponse: function (response) {
        this.prepareData(response);
    },

    /**
     * Updates widget's state
     */
    prepareData: function (response) {

        if (!response.data || ! response.data.status) {
            return;
        }

        this.dataToBind.icon = 'icon-fire';
        this.dataToBind.className = 'herokuDown';

        if (response.data.status.Production == 'green') {
            this.dataToBind.icon = 'icon-ok';
            this.dataToBind.className = 'herokuUp';
        }

        if (response.data.status.Development != 'green') {
            this.dataToBind.icon = 'icon-warning-sign';
            this.dataToBind.className = 'herokuDevDown';
        }

        if (this.dataToBind.icon != 'icon-ok' && response.data.issues[0] && response.data.issues[0].title) {
            this.dataToBind.message = response.data.issues[0].title;
        }

        this.renderTemplate(this.dataToBind);
    }
});
