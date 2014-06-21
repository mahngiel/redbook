// ------------------------------------ GLOBAL ASSIGNMENT -------------------------------------------- //
d = document;

pageWait = $( '<div id="wait"><img src="' + Redbook.asset_url + 'img/preloader.gif" /></div>' );

// ---------------------------------- FUNCTION REGISTRATION ------------------------------------------ //

/* Notification creator */
function createNotification( level, text ) {
    var notice = $( '#notice' ), message = $( '<div class="' + level + '">' + text + '</div>' );

    notice.append( message );
    message.delay( 3000 ).animate( { height: 'toggle', opacity: 'toggle' }, 'slow', function () { $( this ).remove(); } );
}

/* Alert creator */
function createAlert( text ) {
    var answer = confirm( text );
    if ( answer ) {
        document.messages.submit();
    }
    return false;
}

/*
 function history( href ) {
 $.cookie( 'last-page', href );
 }
 */
(function ( $ ) {
    /* Tooltip creation
    $( function () {
        $( d ).tooltip( {
            my   : "center top-10",
            at   : "center top",
            using: function ( position, feedback ) {
                $( this ).css( position );
                $( "<div>" ).addClass( 'arrow' ).addClass( feedback.vertical ).addClass( feedback.horizontal ).appendTo( this );
            }
        } );
    } );
    */
})( jQuery );

var loopAttempts = 0, maxLoopAttempts = 3, timerID = null;

/* Interval manager */
function looper( procFunction, procAction, procTimeout, intTime ) {

    if ( timerID ) clearTimeout( timerID );

    timerID = setInterval( function () {
        if ( procFunction() ) {
            clearTimeout( timerID );
        }
        else
            if ( loopAttempts >= maxLoopAttempts ) {
                clearTimeout( timerID );
                procTimeout();
            }
            else {
                procAction();
            }
    }, intTime );
}

/* DOM preparations handler */
function prepDOM() {

};


// Global delete confirmation
function deleteConfirm() {
    var answer = confirm( "Are you sure you want to delete this item? Once deleted, there will be no way to recover it!" );
    if ( answer ) {
        document.messages.submit();
    }
    return false;
}


// ---------------------------------- PLUGIN REGISTRATION ------------------------------------------ //
/* Set the cookie if not exist */
if ( !$.cookie( Redbook.name ) ) { $.cookie( Redbook.name, Redbook.name ); }

/* Standard HTTP request to genderate DOM handlers */
$( d ).ready( prepDOM() );

/* Random string gen */
$.extend( {
    token: function ( length, special ) {
        var iteration = 0;
        var token = "";
        var randomNumber;
        if ( special == undefined ) {
            var special = false;
        }
        while ( iteration < length ) {
            randomNumber = (Math.floor( (Math.random() * 100) ) % 94) + 33;
            if ( !special ) {
                if ( (randomNumber >= 33) && (randomNumber <= 47) ) { continue; }
                if ( (randomNumber >= 58) && (randomNumber <= 64) ) { continue; }
                if ( (randomNumber >= 91) && (randomNumber <= 96) ) { continue; }
                if ( (randomNumber >= 123) && (randomNumber <= 126) ) { continue; }
            }
            iteration++;
            token += String.fromCharCode( randomNumber );
        }
        return token;
    }
} );

/* Add capitalization to strings */
String.prototype.capitalize = function () {
    return this.charAt( 0 ).toUpperCase() + this.slice( 1 );
}
