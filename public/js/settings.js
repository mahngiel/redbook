/**
 * esports.
 * @author: kreeck
 * Date: 4/17/13
 * Time: 10:01 PM
 */

// ----------------------------------------- SETTINGS MANAGEMENT ---------------------------------- //
// Register input vals
var settingCache = [];
$( d ).ready( function () {
    $( '#settings :input' ).map( function () {

        // Store field value on load
        settingCache[this.name] = this.value;
    } );
} );


// Input event handler
$( d ).on( 'keyup change input', '#settings :input, #settings select', function () {
    var fInput = $( this ).attr( 'name' ), fParent = $( this ).closest( '.field' );

    // Return early for non text-based inputs
    if ( this.type == 'checkbox' || this.type == 'select-one' ) {
        settingUpdate( fInput );

        return;
    }

    // Ensure value has changed
    if ( this.value !== this.lastValue && this.value !== settingCache[this.name] ) {
        if ( fParent.find( 'label > i ' ).length == 0 ) {
            fParent.find( 'label' ).append( '<i class="icon-black-backward" title="Reset value" class="revert" onClick="revert(\'' + fInput + '\')" /></i>' );
        }

        if ( this.timer ) clearTimeout( this.timer );

        this.timer = setTimeout( function () {

            // Fire!
            settingUpdate( fInput );

        }, 1000 );
        this.lastValue = this.value;
    }
} );

function revert( field ) {
    // restore cached value
    $( '#f' + field.capitalize() ).val( settingCache[field] );

    // trigger resave
    settingUpdate( field );
}

function settingUpdate( field ) {

    var setting = $( '#f' + field.capitalize() ), fParent = setting.closest( '.field' ), fValue = '', fStatus = fParent.find( '.input-status' ), fIcon = $( '<i/>', {
        'id': $.token( 5, false )
    } );

    // Reassign values for checkboxes to prove TRUE or FALSE
    if ( setting.attr( 'type' ) == 'checkbox' ) {
        fValue = setting.is( ':checked' ) ? 1 : 0;
    }
    else {
        fValue = setting.val();
    }

    $.ajax( {
        url       : Redbook.base_url + 'admin/settings/' + fParent.attr( 'data-setting' ).replace( /\D/g, '' ),
        data      : '&s=' + field + '&v=' + fValue + '&rules=' + fParent.attr( 'data-validate' ),
        type      : 'put',
        dataType  : 'json',
        beforeSend: function () {
            fStatus.html( fIcon ).append( '<img src="'+ Redbook.asset_url + 'img/indicator.gif" />' );
        },
        complete  : function () {
            fStatus.find('img' ).remove();
        },
        success   : function ( json ) {
            if ( !json.status ) {
                fIcon.prop( 'class', 'icon-red-flag' );

                if ( json.validation ) {
                    $.each( json.validation, function ( index, item ) {
                        if ( typeof item == "object" ) {
                            $.each( item, function ( key, value ) {
                                fStatus.append( value );
                            } );
                        }
                    } );
                }
            }
            else {
                fIcon.prop( 'class', 'icon-black-tick' );
                fStatus.append( json.message );
            }
        }
    } );
}
