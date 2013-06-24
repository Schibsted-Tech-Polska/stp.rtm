$(document).ready(function () {
    var configName = $('.container').data('config-name');

    $('.NumberWidget').each(function(){
        new NumberWidget(this, configName).startListening();
    });

    $('.BuildWidget').each(function(){
        new BuildWidget(this,configName).startListening();
    });

    $('.MessagesWidget').each(function(){
        new MessagesWidget(this, configName).startListening();
    });

    $('.GraphWidget').each(function(){
        new GraphWidget(this, configName).startListening();
    });

    $('.ErrorWidget').each(function(){
        new ErrorWidget(this,configName).startListening();
    });        
});