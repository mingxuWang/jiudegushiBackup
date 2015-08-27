(function($) {

$('#toggle').toggle( 
    function() {
        $('#popout').animate({ left: 0 }, 'slow', function() {
            $('#popout').css( 'left' , '0' );
            $('#toggle').html('<img src="'+slidepanel_script_vars.template_directory_uri+'/images/menu.png" alt="close" />');
        });
    }, 
    function() {
        $('#popout').animate({ left: -250 }, 'slow', function() {
            $('#popout').css( 'left' , '-250px' );
            $('#toggle').html('<img src="'+slidepanel_script_vars.template_directory_uri+'/images/menu.png" alt="close" />');
        });
    }
);


/*
$( "#toggle img" ).click(function() {
    $('#popout').animate({ left: 0 }, 'slow', function() {
            $('#popout').css( 'left' , '0' );
            $('#toggle').html('<img src="/wp-content/themes/corbusier/images/menu.png" alt="close" />');
    });
});*/


})(jQuery);