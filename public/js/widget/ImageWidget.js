/*global Widget */

function ImageWidget(widget, configName) {

    this.widget = widget;
    this.configName = configName;
    this.oldCodeCoverage = 0;

    this.dataToBind = {
        'url': ''
    };
}

ImageWidget.prototype = new Widget();
ImageWidget.prototype.constructor = ImageWidget;

$.extend(ImageWidget.prototype, {
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

        this.dataToBind.value = response.data;
        this.dataToBind.url = response.data.url;
        this.dataToBind.lastUpdate = response.updateTime;

        if (response.data.url.length == 0 && this.oldValue != null && this.oldValue.url.length > 0) {
            this.dataToBind.url = this.oldValue.url;
        }
        
        this.oldValue = this.dataToBind.value;

        this.renderTemplate(this.dataToBind);
    }
});
