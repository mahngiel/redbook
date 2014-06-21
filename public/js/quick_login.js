/**
 * esports.
 * @author: kreeck
 * Date: 3/14/13
 * Time: 4:23 PM
 */
// ------------------------------------ QUICK LOGIN -------------------------------------------- //
var failCount = 0;
$( '#qPassword' ).keyup( function () {
    $( '#qLogCallback' ).html( '' );
    var t = this, qUser = $( '#qUsername' );
    if ( this.value != this.lastValue && $( this ).val().length >= 5 ) {

        if ( this.timer ) clearTimeout( this.timer );

        if ( qUser.val().length > 3 ) {
            this.timer = setTimeout( function () {
                quicklog();
            }, 600 );
        }

        qUser.keyup( function () {

            $( '#qLogStatus' ).html( '' );

            var t = this;

            if ( this.timer ) clearTimeout( this.timer );

            this.timer = setTimeout( function () {
                quicklog();
            }, 600 );

            this.lastValue = this.value;
        } );
    }
} );

function quicklog() {
    $.ajax( {
        url       : Redbook.base_url + 'quicklog',
        data      : '&username=' + $( '#qUsername' ).val() + '&password=' + $( '#qPassword' ).val(),
        type      : 'post',
        dataType  : 'json',
        beforeSend: function () {
            $( '#qLogStatus' ).addClass('aright' ).html( '<img src="' + Redbook.asset_url + 'img/throbber.gif" />' );
        },
        success   : function ( json ) {
            if ( !json.status ) {
                failCount++;
                if ( failCount <= 5 ) {
                    $( '#qLogStatus' ).removeClass('aright').html( '<i class="icon-red-tick"></i>' + json.msg );

                    if ( failCount > 3 ) {
                        $( '#qLogCallback' ).html( '<a href="' + Redbook.base_url + 'account/recover" class="color-site-minor">Recover your account</a>' );
                    }
                }
                else {
                    //window.location.replace( pxn + 'account/timeout' );
                    alert( 'timeout time!' );
                }
            }
            else {
                location.reload();
            }
        }
    } );
}
