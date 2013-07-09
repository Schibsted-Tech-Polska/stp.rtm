/**
 * Main object of a dashboard
 *
 * @class Dashborad
 */
var Dashboard = {

    /**
     * Initiates widgets instances.
     */
    init: function () {
        var configName = $('.container').data('config-name');

        $('.widget').each(function () {
            new window[$(this).data('widget-type')](this, configName).startListening();
        });

        /**
         * Added auto-refreshing whole page every 4 hours.
         * Chrome seems to be not entirely stable with dashboard running
         * for several hours...
         */
        setInterval(function () {
            this.autoReload();
        }.bind(this), 4 * 3600 * 1000);
    },

    autoReload: function () {
        location.reload();
    }
};

$(document).ready(function () {
    Dashboard.init();
});
