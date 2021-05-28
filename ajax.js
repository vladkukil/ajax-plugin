let admin_ajax = document.querySelector('.admin-ajax').getAttribute('data-attr');

jQuery(function ( $ ) {
    $('#get_post_title_form').submit( function (){
        let form = $(this);
        $.ajax({
            url : admin_ajax,
            data : form.serialize(),
            type : 'POST',
            beforeSend : function ( xhr ){
                form.find('button').text( 'Wait pls' );
            },
            success : function ( data ){
                form.find('button').text( 'Get Title' );
                form.after( data );
            }
        });
        return false;
    });
});

