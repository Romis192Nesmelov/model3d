$(document).ready(function ($) {
    window.phoneRegExp = /^((\+)?(\d)(\s)?(\()?[0-9]{3}(\))?(\s)?([0-9]{3})(\-)?([0-9]{2})(\-)?([0-9]{2}))$/gi;

    $('input[name=phone]').keyup(function () {
        unlockSendButton($(this));
    }).mask("+7(999)999-99-99",{completed:function(){
        unlockSendButton($(this));
    }});

    $('input[name=i_agree]').change(function () {
        unlockSendButton($(this));
    });

    $('.modal-dialog form button[type=submit]').click(function(e) {
        e.preventDefault();
    
        var self = $(this),
            form = self.parents('form'),
            textarea = form.find('textarea'),
            select = form.find('select'),
            radio = form.find('input[type=radio]'),
            checkboxes = form.find('input[type=checkbox]'),
            agreeCheckBox = form.find('input[name=i_agree]'),
            agree = agreeCheckBox.length ? agreeCheckBox.is(':checked') : true,
            fields = {},
            token = form.find('input[name=_token]').val();
    
        if (!agree) return false;
    
        fields = processingFields(fields,form.find('input'));
        fields = processingFields(fields,select);
        fields = processingFields(fields,textarea);
        fields = processingCheckFields(fields,radio);
        fields = processingCheckFields(fields,checkboxes);
    
        fields['_token'] = token;
        fields['i_agree'] = agree;
    
        $('.error').html('');
        var allErrors = $('.form-group.has-feedback.has-error');
        allErrors.removeClass('has-error');
        allErrors.find('.help-block').html('');
    
        addLoaderScreen();
    
        $.post(form.attr('action'), fields)
            .done(function(data) {
                var currentModal = self.parents('.modal');

                // If auth complete
                if (data.auth) {
                    currentModal.modal('hide');
                    var authButton = $('ul.nav.navbar-nav li.button');
                    authButton.html('');
                    authButton.append(
                        $('<a></a>').attr('href','/logout').html(window.logout)
                    );
                } else if (data.timer) {
                    var loginPhoneModal = $('#login-phone'),
                        loginSmsModal = $('#login-sms');

                    if (loginPhoneModal.is(':visible')) {
                        loginPhoneModal.modal('hide');
                        loginSmsModal.modal('show');
                    }
                    startTimer(data.timer);
                } else {
                    currentModal.modal('hide');
                    form.trigger('reset');
                    form.find('.btn-primary').attr('disabled','disabled');
                    form.find('span.checked').removeClass('checked');
                    resetCaptcha();
                }

                if (data.message) {
                    currentModal.modal('hide');
                    var messageModal = $('#message');
                    messageModal.find('h2').html(data.message);
                    messageModal.modal('show');
                }
                removeLoaderScreen();
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                var responseMsg = jQuery.parseJSON(jqXHR.responseText);

                $.each(responseMsg.errors, function (field, error) {
                    var errorMsg = error[0],
                        errorBlock = $('.input-'+field, form),
                        errorMessage = errorBlock.find('.help-block');
                    
                    errorBlock.addClass('has-error');
                    errorMessage.html(errorMsg);
                });
                resetCaptcha();
                removeLoaderScreen();
            });
    });
});

function processingFields(fields, inputObj) {
    if (inputObj.length) {
        $.each(inputObj, function (key, obj) {
            if (obj.type != 'checkbox' && obj.type != 'radio') fields[obj.name] = obj.value;
        });
    }
    return fields;
}

function processingCheckFields(fields, inputObj) {
    if (inputObj.length) {
        inputObj.each(function(){
            if($(this).is(':checked')) {
                fields[$(this).attr('name')] = $(this).val();
            }
        });
    }
    return fields;
}

function unlockSendButton(obj) {
    var form = obj.parents('form'),
        button = form.find('button[type=submit]'),
        agreeCheckBox = form.find('input[name=i_agree]'),
        agree = agreeCheckBox.length ? agreeCheckBox.is(':checked') : true,
        phoneInput = form.find('input[name=phone]');

    if (agree && (!phoneInput.length || phoneInput.val().match(window.phoneRegExp))) button.removeAttr('disabled');
    else button.attr('disabled','disabled');
}

function reCaptchaCallback() {
    $('.g-recaptcha').each(function () {
        var id = $(this).attr('id');
        grecaptcha.render(id, {
            'sitekey':window.captchaKey
        });
    });
}

function resetCaptcha() {
    var captchaCount = 0;
    $('.g-recaptcha').each(function () {
        grecaptcha.reset(captchaCount);
        captchaCount++;
    });
}