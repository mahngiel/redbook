var navTarget = $( '#pageTarget' ), navLink = null;

/* Enabled refreshing w/o losing your page */
if ( $.cookie( 'last-page' ) && document.location.href !== $.cookie( 'last-page' ) ) {
    //navTarget.load( $.cookie( 'last-page' ) );
}

$( d ).ajaxStart( function () {
    //navTarget.prepend( pageWait );
} );
$( d ).ajaxError( function () {
    //$('#loading' ).remove();
} );
$( d ).ajaxComplete( function () {
    pageWait.remove();
    prepDOM();
} );

/* ------------------------------------ GENERIC AJAX LINK ------------------------------------------- */
$( d ).on( 'click', 'a.ajaxLink', function ( event ) {

    // defer if ajax off
    if( !Redbook.ajax ) {
        return;
    }

    event.preventDefault();

    navTarget.prepend( pageWait );

    navLink = $( this );

    navTarget.load( navLink.prop( 'href' ) );
    history.pushState( null, null, navLink.prop( 'href' ) );
} );

$( d ).on( 'click', 'a.ajaxFlyIn', function ( event ) {
    event.preventDefault();

    navTarget.prepend( pageWait );

    var fly = $( '<div/>', { id: 'flyIn'} )
        .load( $( this ).prop( 'href' ) )
        .prependTo( navTarget )
        .effect( 'fadeIn', 'slow' );
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
            $( '.help-block' ).text( '' );
        },
        complete  : function () {
            $( '#dialog' ).dialog( 'destroy' );
        },
        success   : function ( json ) {
            createNotification( json.level, json.message );
            if ( !json.status ) {
                if ( json.validation ) {
                    $.each( json.validation, function ( index, item ) {
                        $( '#f' + index.capitalize() ).siblings( '.help-block' ).addClass('alert-danger').text( item );
                    } );
                }
            }
            else {
                if ( Redbook.ajax ) {
                    navTarget.load( json.redirect );
                    history.pushState( null, null, json.redirect );
                }
                else {
                    location = json.redirect;
                }
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
                $( '.help-block' ).text( '' );
            },
            complete  : function () {
                $( '#dialog' ).dialog( 'destroy' );
            },
            success   : function ( json ) {
                createNotification( json.level, json.message );
                if ( !json.status ) {
                    if ( json.validation ) {
                        $.each( json.validation, function ( index, item ) {
                            $( '#f' + index.capitalize() ).siblings( '.help-block' ).text( item );
                        } );
                    }
                }
                else {
                    if ( json.redirect ) {
                        if ( Redbook.ajax_load ) {
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
                navLink.find( 'span' ).toggleClass( 'disabled' );
            }
            if ( json.redirect ) {
                navTarget.load( json.redirect );
            }
        }
    } );
} );

/* ----------------------------------- FORM INPUT AGGREGATE ----------------------------------------- */
function getFormInputs( form ) {
    // Retrieve all tpyical form inputs
    var inputs = form.find( 'input[type="text"], input[type="email"], input[type="password"], input[type="hidden"], textarea, select, input[type="radio"]:checked, input[type="checkbox"]:checked' ), values = '';

    /* If we have the mindmup text editor, let's push that to the stack */
    var editor = form.find('div#editor');
    var images = form.find("input[name='images']");
    if( editor.length ) {
        inputs.push( { "name": editor.attr('data-formInput'), "value": '"'+editor.html()+'"' } );
    }
    if( images.length ) {
        input.push( { "name": "images", "value": images.val() });
    }

    // count how many ele's we have so we create correct values
    var i=inputs.length;

    $.each( inputs, function ( index, attr ) {
        i--;
        values = values.concat( attr.name + '=' + attr.value + (i>=1 ? '&' : '') );
    } );

    return values;

}
