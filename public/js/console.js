$(d).on('keydown', 'input[name="redbook-terminal"]', function(event) {

    // fire command
    if( event.keyCode == 13 )
    {
        fireCommand( $(this ).val() );
    }

});

function fireCommand( command ) {

    $.ajax( {
        url       : Redbook.base_url + 'call',
        data      : 'command=' + command,
        type      : 'post',
        dataType  : 'json',
        beforeSend: function () {
//            navTarget.prepend( pageWait );
//            $( '.input-callback' ).text( '' );
//            $( '.form-group' ).attr( 'class', 'form-group' );
        },
        complete  : function () {
        },
        success   : function ( json ) {
//            createNotification( json.level, json.message );
            if ( !json.status ) {
            }
            else {
//                navTarget.load( json.redirect );
//                history.pushState( null, null, json.redirect );
            }
        }
    } );
}
