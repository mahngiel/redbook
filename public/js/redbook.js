/**
 * Redbook.
 * @author: kreeck
 * Date: 7/12/14
 * Time: 9:16 PM
 */

d = document;
Array.prototype.diff = function ( a ) {
    return this.filter( function ( i ) {return a.indexOf( i ) < 0;} );
};

//Self-Executing Anonymous Function: Part 2 (Public & Private)
(function ( Redbook, $, undefined ) {

    //Private Properties
    var schema = [];

    //Public Properties
    Redbook.ingredient = "Bacon Strips";

    //Public Methods
    /* Notification creator */
    Redbook.createNotification = function ( level, text ) {
        var notice = $( '#redbook-notifications' ), message = $( '<div class="notice ' + level + '">' + text + '</div>' );
        notice.append( message );
        message.delay( 3000 ).animate( {
            height: 'toggle', opacity: 'toggle'
        }, 'slow', function () { $( this ).remove(); } );
    };

    /* Cache keys */
    Redbook.setSchema = function ( objects ) {
        objs = JSON.parse( objects );

        schema = [];

        $.each( objs, function ( key, value ) {
            schema.push( value );
        } );

    };

    Redbook.getSchema = function () {
        return schema;
    };

    Redbook.searchSchema = function ( term ) {
        results = [];
        $.each( schema, function ( key, value ) {
            if ( ~value.indexOf( term ) ) {
                results.push( value );
            }
        } );

        return results;
    };

    Redbook.filterSchemaTree = function ( term ) {
        var searchResults = Redbook.searchSchema( term );

        /** Revert DOM to default */
        if ( term == '' ) {
            $( '.filterItemOut' ).removeClass( 'filterItemOut' ).removeClass( 'filterContainerOut' ).removeClass( 'filterParentOut' );
            return false
        }

        /** Remove tree item visibility from dom */
        $.each( schema.diff( searchResults ), function ( k, v ) {
            $( '*[data-namespace="' + v + '"]' ).addClass( 'filterItemOut' ).removeClass( 'filterContainerOut' ).removeClass( 'filterParentOut' );
        } );

        $.each( searchResults, function ( k, v ) {
            $( '*[data-namespace="' + v + '"]' ).removeClass( 'filterItemOut' ).parents( '.schema-container' ).addClass( 'filterContainerOut' ).attr( 'style', '' ).parents( '.schema-namespace' ).addClass( 'filterParentOut' ).attr( 'style', '' );
        } );
    };

    mapAvailableSchema();

    //Private Methods
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
            inputs.push( {"name": editor.attr( 'data-formInput' ), "value": '"' + editor.html() + '"'} );
        }
        if ( images.length ) {
            input.push( {"name": "images", "value": images.val()} );
        }

        // count how many ele's we have so we create correct values
        var i = inputs.length;

        $.each( inputs, function ( index, attr ) {
            i--;
            values = values.concat( attr.name + '=' + attr.value + (i >= 1 ? '&' : '') );
        } );

        return values;
    }

    function mapAvailableSchema() {
        if ( $( '.tree-root' ).length ) {
            schema = [];

            $.each( $( '*[data-namespace]' ), function ( k, v ) {
                attr = $( v ).attr( 'data-namespace' );
                if ( $.inArray( attr, schema ) === -1 ) schema.push( attr );
            } );
        }
    }

    /* ----------------------------------- NAVIGATION ------------------------------------------ */
    var schemaChangeTarget = '#redbook-schema',
        databaseListContainer = '#redbook-databases',
        schemaTreeItem = '.schema-key',
        pageWait = $( '<div id="wait"><img src="' + Redbook.assetUrl + 'img/preloader.gif" /></div>' ), navRoot = $( '#page' ),
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
        $( databaseListContainer + ' li' ).removeClass( 'active' );
        navTarget = $( schemaChangeTarget );
        navTarget.prepend( pageWait );
        navLink = $( this );
        navLink.closest('li' ).addClass('active');
        navTarget.load( navLink.prop( 'href' ), function () {mapAvailableSchema();} );
        history.pushState( null, null, navLink.prop( 'href' ) );
    } );

    /**
     * Schema key change
     */
    $( d ).on( 'click', 'a.ajaxSchemaKey', function ( event ) {
        event.preventDefault();
        $( schemaTreeItem+'.active' ).removeClass( 'active' );
        navTarget = $( schemaChangeTarget );
        navTarget.prepend( pageWait );
        navLink = $( this );
        navLink.parent(schemaTreeItem).addClass('active');
        $( '#page' ).load( navLink.prop( 'href' ) );
        history.pushState( null, null, navLink.prop( 'href' ) );
    } );

}( window.Redbook = window.Redbook || {}, jQuery ));

$( d ).on( 'input change', 'input#schemaSearch', function () {

    var searchTerm = $( this ).val();

    // Ensure value has changed
    if ( this.value !== this.lastValue && this.value.trim() !== this.lastValue ) {

        if ( this.timer ) clearTimeout( this.timer );

        this.timer = setTimeout( function () {

            // Fire!
            Redbook.filterSchemaTree( searchTerm );

        }, 500 );

        this.lastValue = this.value;
    }
} );
