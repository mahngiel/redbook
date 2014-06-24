$( d ).on( 'click', '.makeEditable', function ( e ) {
    e.preventDefault();

    if ( $( this ).hasClass( 'open' ) ) {
        $( this ).removeClass( 'open' );
        return removeEditInputs();
    }

    $( this ).addClass( 'open' );
    return addEditInputs();
} );

function addEditInputs() {
    $( '.editable' ).each( function ( key, element ) {
        $( this ).html( '<input class="form-control" type="text" name="' + $( this ).attr( 'data-key' ) + '" value="' + $( this ).html() + '"/>' );
    } );
}

function removeEditInputs() {
    $( '.editable' ).each( function ( key, element ) {
        $( this ).text( $( 'input[name="' + $( this ).attr( 'data-key' ) + '"]' ).val() );
    } );

}

/** Key Caching **/
var keyCache = [];
$( d ).ready( function () {
    $( '.editable' ).each( function ( key, element ) {
        keyCache[ $( element ).attr( 'data-key' ) ] = $( element ).text();
    } );
} );

$( d ).on( 'dblclick', '.editable', function () {

    var fVal = $( this ).text(), fKey = $( this ).attr( 'data-key' );

    $( this ).html( makeInput( fKey, fVal ) );
} );

function revert( key ) {
    // restore cached value
    $( '#f' + key.capitalize() ).val( keyCache[key] );
}

function cancelEdit( arg ) {
    ele = $( arg );
    if ( ele.find( 'i' ).hasClass( 'fa-times' ) ) {
        ele.closest( '.editable' ).text( keyCache[ele.siblings( 'input' ).attr( 'name' )] );
    }
    else {
        ele.siblings( 'input' ).val( keyCache[ele.siblings( 'input' ).attr( 'name' )] );
        ele.find('i' ).removeClass( 'fa-refresh' ).addClass( 'fa-times' );
    }
}

function makeInput( name, value ) {
    return '<div class="input-group"><input class="form-control" type="text" name="' + name + '" value="' + value + '"/><span class="input-group-addon cursor" onclick="cancelEdit(this)"><i class="fa fa-times"></i></span></div>';
}

// Input event handler
$( d ).on( 'keyup change input', '#definition :input, #settings select', function () {
    var fInput = $( this ).attr( 'name' ), fParent = $( this ).closest( '.editable' );

    // Ensure value has changed
    if ( this.value !== this.lastValue && this.value !== keyCache[this.name] ) {
        if ( fParent.find( 'i' ).hasClass( 'fa-times' ) ) {
            fParent.find( 'i' ).removeClass( 'fa-times' ).addClass( 'fa-refresh' );
        }

        this.timer = setTimeout( function () {

        }, 1000 );
        this.lastValue = this.value;
    }
} );
