// define application namespace
Application = {
    Controller: {}
};

/**
 * Trigger an javascript native alert
 *
 * @param  string str The text to display
 * @return event Alert javascript event
 */
Application.alert = function(str) {

    alert(str);
}

jQuery(document).ready(function($) {
    
    // invoca o controlador e o método solicitados
    Application.vars  = {

        //api_url     : 'http://localhost/api/',
        api_url     : 'http://192.168.150.100/',
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

            },
            success: function(XMLHttpRequest) 
            {
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

                    for (var fieldName in data.errors) 
                    {
                        for (var i in data.errors[fieldName]) alert(data.errors[fieldName][i]);
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
