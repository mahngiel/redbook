//var navRoot = $( '#page' ), navTarget = $( '#page' ), navLink = null;

/* Enabled refreshing w/o losing your page */
if ( $.cookie( 'last-page' ) && document.location.href !== $.cookie( 'last-page' ) ) {
    //navTarget.load( $.cookie( 'last-page' ) );
}

//$( d ).ajaxStart( function () {
//    navTarget.prepend( pageWait );
//} );
//$( d ).ajaxError( function () {
//    pageWait.remove();
//} );
//$( d ).ajaxComplete( function () {
//    pageWait.remove();
//    prepDOM();
//} );

// Monitor the URI
window.addEventListener( "popstate", function ( e ) {
    // auto ajax on browser history change
    navTarget.load( location.pathname );
} );

//$( d ).on( 'click', 'a.changeSchema', function ( event ) {
//    event.preventDefault();
//    Redbook.changeSchema( this );
//    var targetElement = '#redbook-schema';
//
//    // set navRoot
//    navTarget = $( targetElement );
//
//    navTarget.prepend( pageWait );
//
//    navLink = $( this );
//
//    navTarget.load( navLink.prop( 'href' ) );
//
//    history.pushState( null, null, navLink.prop( 'href' ) );
//} );
//
//$( d ).on( 'click', 'a.ajaxSchemaKey', function ( event ) {
//
//    event.preventDefault();
//
//    navTarget.prepend( pageWait );
//
//    navLink = $( this );
//
//    $( '#page' ).load( navLink.prop( 'href' ) );
//
//    history.pushState( null, null, navLink.prop( 'href' ) );
//} );

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
