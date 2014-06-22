var navRoot = $( '#page' ), navTarget = $( '#page' ), navLink = null;

/* Enabled refreshing w/o losing your page */
if ( $.cookie( 'last-page' ) && document.location.href !== $.cookie( 'last-page' ) ) {
    //navTarget.load( $.cookie( 'last-page' ) );
}

$( d ).ajaxStart( function () {
    navTarget.prepend( pageWait );
} );
$( d ).ajaxError( function () {
    pageWait.remove();
} );
$( d ).ajaxComplete( function () {
    pageWait.remove();
    prepDOM();
} );

// Monitor the URI
window.addEventListener( "popstate", function ( e ) {
    // auto ajax on browser history change
    navTarget.load( location.pathname );
} );

/* ------------------------------------ GENERIC AJAX LINK ------------------------------------------- */
$( d ).on( 'click', 'a.ajaxLink', function ( event ) {

    event.preventDefault();

    navRoot.prepend( pageWait );

    navLink = $( this );

    navTarget.load( navLink.prop( 'href' ) );

    history.pushState( null, null, navLink.prop( 'href' ) );
} );

/* --------------------------------- GENERIC AJAX FLYIN LINK ---------------------------------------- */
$( d ).on( 'click', 'a.ajaxFlyIn', function ( event ) {
    event.preventDefault();

    navRoot.prepend( pageWait );

    var fly = $( '<div/>', { id: 'flyIn'} ).load( $( this ).prop( 'href' ) ).prependTo( navTarget ).effect( 'fadeIn', 'slow' );
} );

/* -------------------------------- OBJECT REQUEST OPERATIONS --------------------------------------- */
$( d ).on( 'click', 'a.ajaxRequest', function ( event ) {
    event.preventDefault();
    navLink = $( this );
    var doLoad = true;

    $.ajax( {
        url       : navLink.prop( 'href' ),
        type      : 'get',
        dataType  : 'json',
        beforeSend: function () {
            navTarget.prepend( pageWait );
        },
        complete  : function () {
            $( '#loading' ).remove();
            if ( doLoad ) {
                navTarget.load( navLink.prop( 'href' ) );
                history.pushState( null, null, navLink.prop( 'href' ) );
            }
        },
        success   : function ( json ) {
            if ( !json.status ) {
                createNotification( json.level, json.message );
                doLoad = false;
            }
        }
    } );
} );

/* ------------------------------------ GENERIC AJAX POST ------------------------------------------- */
$( d ).on( 'click', '.submit', function ( event ) {
    event.preventDefault();
    navLink = $( this );

    var form = navLink.closest( 'form' );

    $.ajax( {
        url       : form.prop( 'action' ),
        data      : getFormInputs( form ),
        type      : 'post',
        dataType  : 'json',
        beforeSend: function () {
            navTarget.prepend( pageWait );
            $( '.input-callback' ).text( '' );
            $( '.form-group' ).attr( 'class', 'form-group' );
        },
        complete  : function () {
        },
        success   : function ( json ) {
            createNotification( json.level, json.message );
            if ( !json.status ) {
                if ( json.validation ) {
                    $.each( json.validation, function ( index, item ) {
                        $( '#f' + index.capitalize() ).closest( '.form-group' ).addClass( 'has-error' ).find( '.input-callback' ).addClass( 'text-danger' ).text( item );
                    } );
                }
            }
            else {
                navTarget.load( json.redirect );
                history.pushState( null, null, json.redirect );
            }
        }
    } );

} );

/* ----------------------------------- GENERIC AJAX DELETE ------------------------------------------ */
$( d ).on( 'click', 'a.ajaxDelete', function ( event ) {
    event.preventDefault();
    navLink = $( this );

    if ( confirm( 'Delete this item? This action cannot be undone!' ) ) {
        var form = d.createElement( 'form' );

        navLink.after( $( form ).attr( {
            method: 'POST',
            action: navLink.prop( 'href' ),
            id    : 'delForm'
        } ).append( '<input type="hidden" name="_method" value="DELETE"/>' ).append( '<input type="hidden" name="item_id" value="' + navLink.closest( '.owner' ).attr( 'data-id' ).replace( /\D/g, '' ) + '"/>' ) );

        form = $( '#delForm' );

        $.ajax( {
            url       : form.prop( 'action' ),
            data      : getFormInputs( form ),
            type      : 'post',
            dataType  : 'json',
            beforeSend: function () {
                $( '.input-callback' ).text( '' );
            },
            complete  : function () {
                $( '#dialog' ).dialog( 'destroy' );
            },
            success   : function ( json ) {
                createNotification( json.level, json.message );
                if ( !json.status ) {
                    if ( json.validation ) {
                        $.each( json.validation, function ( index, item ) {
                            $( '#f' + index.capitalize() ).siblings( '.input-callback' ).text( item );
                        } );
                    }
                }
                else {
                    if ( json.redirect ) {
                        if ( DeviceVault.ajax_load ) {
                            navTarget.load( json.redirect );
                            history.pushState( null, null, json.redirect );
                        }
                        else {
                            location = json.redirect;
                        }
                    }
                    else {
                        navLink.closest( '.owner' ).fadeOut( 250, function () { $( this ).remove(); } );
                    }
                }
            }
        } );
    }
    return false;
} );

/* ----------------------------------- GENERIC AJAX TOGGLE ------------------------------------------ */
$( d ).on( 'click', 'a.ajaxToggle', function ( event ) {
    event.preventDefault();
    navLink = $( this );

    var id = navLink.closest( '.toggleParent' ).attr( 'data-id' ).replace( /\D/g, '' ), property = navLink.attr( 'data-toggle' );

    $.ajax( {
        url       : navLink.prop( 'href' ),
        type      : 'POST',
        data      : 'id=' + id + '&property=' + property,
        dataType  : 'json',
        beforeSend: function () {},
        complete  : function () {},
        success   : function ( json ) {
            createNotification( json.level, json.message );

            if ( json.status ) {

                /** Check for toggleAttr */
                if ( json.toggleAttr ) {
                    /** Change toggle val if present */
                    if ( json.toggleAttr.value ) {
                        navLink.attr( 'data-toggle', json.toggleAttr.value );
                    }

                    /** Change icon if present */
                    if ( json.toggleAttr.class ) {
                        navLink.find( '.entypo' ).prop( 'class', json.toggleAttr.class );
                    }

                    /** Change title if present */
                    if ( json.toggleAttr.title ) {
                        navLink.closest( '.toggleParent' ).attr( 'title', json.toggleAttr.title );
                    }
                }
            }

            if ( json.redirect ) {
                navTarget.load( json.redirect );
            }
        }
    } );
} );

$( d ).on( 'click', 'a.changeSchema', function ( event ) {
    event.preventDefault();

    var targetElement = '#redbook-schema';

    // set navRoot
    navTarget = $( targetElement );

    navTarget.prepend( pageWait );

    navLink = $( this );

    navTarget.load( navLink.prop( 'href' ) );

    history.pushState( null, null, navLink.prop( 'href' ) );
} );

$( d ).on( 'click', 'a.ajaxSchemaKey', function ( event ) {

    event.preventDefault();

    navTarget.prepend( pageWait );

    navLink = $( this );

    $('#page').load( navLink.prop( 'href' ) );

    history.pushState( this, null, navLink.prop( 'href' ) );
} );

/* ----------------------------------- FORM INPUT AGGREGATE ----------------------------------------- */
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
