// define application namespace
Application = {
    Controller: {}
};

jQuery(document).ready(function($) {
    
    // invoca o controlador e o método solicitados
    Application.vars  = {

        //api_url     : 'http://localhost/',
        api_url     : 'http://46.101.142.59/', // DigitalOcean test
        controller  : $('meta[name=controller]').attr('content'),
        method      : $('meta[name=method]').attr('content'), 
        directory   : $('meta[name=directory]').attr('content')
    };
    
    var camelizedController = $.map(Application.vars.controller.split('_'), function(val) { return val.substr(0,1).toUpperCase() + val.substr(1) } ).join('');
    var camelizedDirectory = $.map(Application.vars.directory.split('/'), function(val) { return val.substr(0,1).toUpperCase() + val.substr(1) } ).join('');
    
    var igniter = camelizedDirectory ? camelizedDirectory+'__'+camelizedController : camelizedController;
    
    Application.Controller[igniter] &&
    Application.Controller[igniter]['init'] &&
    Application.Controller[igniter]['init'].call();

    Application.Controller[igniter] &&
    Application.Controller[igniter][Application.vars.method] &&
    Application.Controller[igniter][Application.vars.method].call();

});

/**
 * Funcao responsavel por tratar o envio de formularios por Ajax
 */
jQuery.fn.ajaxForm = ( function(options) 
{
    var options = $.extend(
    {
        successCallback : (function() {}),
        errorCallback   : (function() {})
    }, options);

    return this.submit( function() 
    {
        var form = $(this);
        
        $.ajax({

            type: 'post',
            url: form.attr('action'),
            data: form.serialize(),
            beforeSend: function() 
            {
                form.find('.has-error').removeClass('has-error');
                form.find('.help-block').remove();
            },
            success: function(XMLHttpRequest) 
            {
                form.find('input[type=text], input[type=password], input[type=email]').val('')

                if (options.successCallback) 
                {
                    options.successCallback(XMLHttpRequest);
                }
            },
            error: function(XMLHttpRequest) 
            {
                if (XMLHttpRequest.status == '422') 
                {
                    var data = $.parseJSON(XMLHttpRequest.responseText);

                    for (var fieldName in data) 
                    {
                        for (var i in data[fieldName])
                        {
                            $('input[name=' + fieldName + ']').parent().parent().addClass('has-error');
                            $('input[name=' + fieldName + ']').parent().append('<span class="help-block">' + data[fieldName][i] + '</span>');
                            //alert(data[fieldName][i]);
                        }
                    }
                    
                    if (options.errorCallback) 
                    {
                        options.errorCallback(XMLHttpRequest);
                    }
                    
                }
                else
                {
                    alert('Unexpected error!');
                }
            }
        });

        return false;
    });
});

/**
 * Funcao responsavel por calcular a forca da senha
 */
jQuery.fn.passwordStrength = ( function(options)
{
    var options = $.extend(
    {
        strengthBox : '.password_strength',
        strengthResult : '.password_strength_result'
    }, options);

    var score = 0;
    var a = $(this).val();
    var desc = new Array();
    
    $(options.strengthResult).text('');
    $(options.strengthBox).show();

    // strength desc
    desc[0] = "Muito curta";
    desc[1] = "Fraca";
    desc[2] = "Boa";
    desc[3] = "Forte";
    desc[4] = "Muito forte";
    
    // password length
    if (a.length >= 6) {
        score++;
    }

    // at least 1 digit in password
    if (a.match(/\d/)) {
        score++;
    }

    // at least 1 capital & lower letter in password
    if (a.match(/[A-Z]/) && a.match(/[a-z]/)) {
        score++;
    }

    // at least 1 special character in password {
    if ( a.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) ) {
        score++;
    }

    if(a.length > 0) {
        //show strength text
        $(options.strengthResult).text(desc[score]);
    }
});
