$(document).ready(function ($) {
    $('input[name=code]').mask("99-99-99",{completed:function(){
        unlockLoginSmsButton();
    }});
});

function unlockLoginSmsButton() {
    var code = $('input[name=code]').val(),
        button = $('#sms-login');

    if (code.length == 8) button.removeAttr('disabled');
    else button.attr('disabled','disabled');
}

function startTimer(seconds) {
    var timerContainer = $('#timer');
    timerContainer.html(seconds);
    window.timer = setInterval(function () {
        seconds--;
        timerContainer.html(seconds);
        if (!seconds) {
            clearInterval(window.timer);
            $('#resend-sms').removeAttr('disabled');
        }
    },1000);
}