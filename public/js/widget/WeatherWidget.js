/*global Widget */

function WeatherWidget(widget, configName) {

    this.widget = widget;
    this.configName = configName;
    this.oldCodeCoverage = 0;
    this.dataToBind = {
        name: '',
        icon: '',
        temperature: 0,
        pressure: 0
    };
    this.iconsMap = {
        '01d': '1',
        '02d': 'A',
        '03d': '3',
        '04d': '3',
        '09d': 'K',
        '10d': 'J',
        '11d': 'Q',
        '13d': 'I',
        '50d': 'Z',

        '01n': '1',
        '02n': 'a',
        '03n': '3',
        '04n': '3',
        '09n': 'k',
        '10n': 'j',
        '11n': 'q',
        '13n': 'i',
        '50n': 'z'
    }
}

WeatherWidget.prototype = new Widget();
WeatherWidget.prototype.constructor = WeatherWidget;

$.extend(WeatherWidget.prototype, {
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

        if (!response.data) {
            return;
        }

        this.dataToBind.name = response.data.name;
        this.dataToBind.icon = this.iconsMap[response.data.weather[0].icon];
        this.dataToBind.temperature = response.data.main.temp;
        this.dataToBind.pressure = response.data.main.pressure;

        this.renderTemplate(this.dataToBind);
    }
});
