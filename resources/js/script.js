define( [ "jquery" ], function( $ ) {
    $(".toggle-password").click(function() {
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password" || input.attr("type") == "password_confirmation") {
            $(this).find('.eye').hide();
            $(this).find('.eye-off').show();
            input.attr("type", "text");
        } else {
            $(this).find('.eye-off').hide();
            $(this).find('.eye').show();
            input.attr("type", "password");
        }
    });
} );
