$(document).ready(function () {
    var widget = $("#vgtvCpuUsage");

    $('.NumberWidget').each(function(){
        new NumberWidget(this).startListening();
    });


});