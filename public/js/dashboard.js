$(document).ready(function () {
    var widget = $("#vgtvCpuUsage");
    var configName = $('.container').data('config-name');

    $('.NumberWidget').each(function(){
        new NumberWidget(this,configName).startListening();
    });

    $('.BuildWidget').each(function(){
        new BuildWidget(this).startListening();
    });


});