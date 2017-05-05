Application.Controller.Home = (function($) {

    function init() {

        //
    }

    function index() {
        
        // Apply ajaxForm function to make ajax request by default
        $('form[name=signup]').ajaxForm({
            successCallback : (function() { alert('Obrigado pro se registar.'); })
        });

        // Verify the email
        $('body').on('blur', 'input[name=email]', function() {
            alert('Verificar uso do email.');
        });

        // Apply mask
        $('input[name=cod_postal]').mask('0000-000');
        $('input[name=nif]').mask('000000000');

        // Control telephone mask
        $('body').on('change', 'select[name=pais]', function() {
            $('input[name=telefone]').val('')
            if ($(this).val() == 'portugal') {
                $('input[name=telefone]').mask('999 999 999');
                $('.telefone_area').html('+351')
            } else if ($(this).val() == 'espanha') {
                $('input[name=telefone]').mask('999 99 99 99');
                $('.telefone_area').html('+34')
            } else if ($(this).val() == 'argentina') {
                $('input[name=telefone]').mask('999 99-9999-9999');
                $('.telefone_area').html('+54')
            } else if ($(this).val() == 'alemanha') {
                $('input[name=telefone]').mask('99999 9999999');
                $('.telefone_area').html('+49')
            }
        });
        $('select[name=pais]').trigger('change');

        $('body').on('focus keyup', 'input[name=password], input[name=password_confirm]', function () {
            // call to the function defined at app.js
            $(this).passwordStrength({
                strengthBox : '.password_strength',
                strengthResult : '.password_strength_result'
            });
        });

        $('body').on('blur', 'input[name=password], input[name=password_confirm]', function () {
            $('.password_strength').hide();
        });

        // Set the form action URL
        $('form[name=signup]').attr('action', Application.vars.api_url + 'signup');
    }

    return {

        'init'  : init,
        'index' : index
    };

})(jQuery);
