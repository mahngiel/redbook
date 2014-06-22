// ------------------------------------ GLOBAL ASSIGNMENT -------------------------------------------- //
d = document;

var pageWait = $( '<div id="wait"><img src="' + Redbook.asset_url + 'img/preloader.gif" /></div>' );

// ---------------------------------- FUNCTION REGISTRATION ------------------------------------------ //

/* Notification creator */
function createNotification( level, text ) {
    var notice = $( '#redbook-notifications' ), message = $( '<div class="notice ' + level + '">' + text + '</div>' );

    notice.append( message );
    message.delay( 3000 ).animate( { height: 'toggle', opacity: 'toggle' }, 'slow', function () { $( this ).remove(); } );
}

/**
 * Notification remover
 */
(function ( $ ) {
    var message = $( '.notice' );

    if ( message.length ) {
        message.delay( 3000 ).animate( { height: 'toggle', opacity: 'toggle' }, 'slow', function () { $( this ).remove(); } );
    }

})( jQuery );

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
    /* if ( $( 'select' ).length ) { $( "select" ).select2( { placeholder: "Select an Option", allowClear: false} ); }*/

}

/**
 * Load a script to the page
 *
 * @param script_source
 */
function loadScript( script_source ) {

    var script = document.createElement( 'script' );
    script.type = 'text/javascript';
    script.src = script_source + '&callback=initialize';
    document.body.appendChild( script );
}

/**
 * Load a page into a container
 *
 * @param container
 * @param targetURI
 */
function loadPage( container, targetURI ) {

    /* show loader */
    container.prepend( pageWait );

    //load page
    container.load( Redbook.base_url + targetURI );
}

/**
 * Process a function at an interval
 *
 * @param processFunction
 * @param interval
 */
function processAtInterval( processFunction, interval ) {
    if ( typeof  processFunction == "function" && interval > 0 ) {
        setInterval( function () {
            processFunction;
            console.log( 'ran process' );
        }, (interval * 1000 ) );
    }
}

/**
 * Retrieve a URI segment
 *
 * @param segment
 * @returns {*}
 */
function uriSegment( segment ) {
    var uriSegments = window.location.pathname.split( '/' );
    return uriSegments[ segment ];
}

// ---------------------------------- PLUGIN REGISTRATION ------------------------------------------ //
/* Set the cookie if not exist */
if ( !$.cookie( Redbook.name ) ) { $.cookie( Redbook.name, Redbook.name ); }

/* Standard HTTP request to generate DOM handlers */
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

/**
 * Google Webfonts
 *
 * @type {{google: {families: string[]}}}
 */
WebFontConfig = {
    google: { families: [ 'Droid+Sans::latin', 'Oswald:400,300:latin', 'Source+Code+Pro:400,700:latin' ] }
};
(function () {
    var wf = document.createElement( 'script' );
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName( 'script' )[0];
    s.parentNode.insertBefore( wf, s );
})();

$( d ).on( 'click', 'a.schema-collapse', function ( e ) {
    e.preventDefault();
    $( this ).siblings( '.schema-container' ).slideToggle();
} );
