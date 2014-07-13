/**
 * Redbook.
 * @author: kreeck
 * Date: 7/12/14
 * Time: 9:16 PM
 */

d = document;

//Self-Executing Anonymous Function: Part 2 (Public & Private)
(function ( Redbook, $, undefined ) {

    //Private Properties

    //Public Properties
    Redbook.ingredient = "Bacon Strips";

    //Public Methods
    Redbook.fry = function () {
        var oliveOil;

        addItem( "\t\n Butter \n\t" );
        addItem( oliveOil );
        console.log( "Frying " + Redbook.ingredient );
    };

    /* Notification creator */
    Redbook.createNotification = function ( level, text ) {
        var notice = $( '#redbook-notifications' ), message = $( '<div class="notice ' + level + '">' + text + '</div>' );
        notice.append( message );
        message.delay( 3000 ).animate( {
            height : 'toggle',
            opacity: 'toggle'
        }, 'slow', function () { $( this ).remove(); } );
    };

    //Private Methods
    function addItem( item ) {
        if ( item !== undefined ) {
            console.log( "Adding " + $.trim( item ) );
        }
    }

    /**
     *
     * @param form
     * @returns {string}
     */
    function getFormInputs( form ) {
        // Retrieve all tpyical form inputs
        var inputs = form.find( 'input[type="text"], input[type="email"], input[type="password"], input[type="hidden"], textarea, select, input[type="radio"]:checked, input[type="checkbox"]:checked' ), values = '';

        /* If we have the mindmup text editor, let's push that to the stack */
        var editor = form.find( 'div#editor' );
        var images = form.find( "input[name='images']" );
        if ( editor.length ) {
            inputs.push( { "name": editor.attr( 'data-formInput' ), "value": '"' + editor.html() + '"' } );
        }
        if ( images.length ) {
            input.push( { "name": "images", "value": images.val() } );
        }

        // count how many ele's we have so we create correct values
        var i = inputs.length;

        $.each( inputs, function ( index, attr ) {
            i--;
            values = values.concat( attr.name + '=' + attr.value + (i >= 1 ? '&' : '') );
        } );

        return values;
    }

    /* ----------------------------------- NAVIGATION ------------------------------------------ */
    var schemaChangeTarget = '#redbook-schema',
        pageWait = $( '<div id="wait"><img src="' + Redbook.assetUrl + 'img/preloader.gif" /></div>' ),
        navRoot = $( '#page' ),
        navTarget = $( '#page' ),
        navLink = null;

    $( d ).ajaxStart( function () { navTarget.prepend( pageWait ); } );
    $( d ).ajaxError( function () { pageWait.remove(); } );
    $( d ).ajaxComplete( function () { pageWait.remove(); } );

    /**
     * Database change
     */
    $( d ).on( 'click', 'a.changeSchema', function ( event ) {
        event.preventDefault();
        navTarget = $( schemaChangeTarget );
        navTarget.prepend( pageWait );
        navLink = $( this );
        navTarget.load( navLink.prop( 'href' ) );
        history.pushState( null, null, navLink.prop( 'href' ) );
    } );

    /**
     * Schema key change
     */
    $( d ).on( 'click', 'a.ajaxSchemaKey', function ( event ) {
        event.preventDefault();
        navTarget.prepend( pageWait );
        navLink = $( this );
        $( '#page' ).load( navLink.prop( 'href' ) );
        history.pushState( null, null, navLink.prop( 'href' ) );
    } );

}(window.Redbook = window.Redbook || {}, jQuery));
