/**
 * eSports CMS
 * @author kreeck
 * Date: 3/13/13
 * Time: 11:48 PM
 */

// ----------------------------------------- USER REGISTRATION ---------------------------------- //
var registerCache = {}, validated = null, validationAttempts = 0, maxValidationAttempts = 3, timerID = null;
$( d ).ready( function () {
    $( '#registration :input:visible' ).map( function () {

        // Store field value on load
        registerCache[this.name] = false;

        // user refreshed, recheck
        if ( $( this ).val() != '' ) {
            validateInput( $( this ).attr( 'name' ), $( this ).val(), $( this ).siblings( '.input-status' ) );
        }
    } );
} );

// on input data entry
$( d ).on( 'keyup change click input', '#registration :input', function () {

    // set field name, value, and span id
    var fInput = $( this ).attr( 'name' ), fValue = $( this ).val(), fStatus = $( this ).siblings( '.input-status' );

    // Activity exists. reset counter
    validationAttempts = 0;

    if ( this.value != this.lastValue && $.trim(fValue).length >= 3 ) {

        // Clear the timer
        if ( this.timer ) clearTimeout( this.timer );

        this.timer = setTimeout( function () {

            // Cross-check password matching
            if ( fInput == 'password_confirm' ) {

                if ( validated == null || validated == true || validationAttempts < maxValidationAttempts ) intervalValidate();

                if ( fValue.length < 5 ) {
                    $( 'input[name="' + fInput + '"]' ).addClass( 'error' );
                    $( fStatus ).html( '<i class="icon-red-flag"></i><span>Passwords must be a minimum of 6 characters</span>' );
                }
                if ( fValue.length >= 5 ) {
                    fPass = $( '#fPassword' ).val();
                    // update registration cache
                    registerCache[fInput] = !!(fValue == fPass);
                    registerCache['password'] = !!(fValue == fPass);

                    if ( fValue != fPass ) {
                        $( 'input[name="' + fInput + '"]' ).addClass( 'error' );
                        $( fStatus ).html( '<i class="icon-red-flag"></i><span>Passwords do not match!</span>' );
                    }
                    else {
                        $( 'input[name="' + fInput + '"]' ).removeClass( 'error' );
                        $( 'input[name="password"]' ).removeClass( 'error' );
                        $( fStatus ).html( '<i class="icon-black-tick"></i><span>Passwords match</span>' );
                    }
                }
            }

            // Password field. Not much to do since we're validating the confirmation
            // But we can at least inform of lenght limits
            else if ( fInput == 'password' ) {
                var fConfirm = $('#fPasswordConfirm');

                if ( validated == null || validated == true || validationAttempts < maxValidationAttempts ) intervalValidate();

                // Does password meet standards?
                if ( fValue.length < 5 ) {
                    $( 'input[name="' + fInput + '"]' ).addClass( 'error' );
                    fConfirm.siblings( '.input-status' ).html( '<i class="icon-red-flag"></i><span>Passwords must be a minimum of 6 characters</span>' );
                    registerCache[fInput] = false;
                }
                else {
                    if( fConfirm.val() == '' ) {
                        if( fValue == fConfirm.val() ) {
                            $( 'input[name="' + fInput + '"]' ).removeClass( 'error' );
                            fConfirm.siblings( '.input-status' ).html( '' );
                            registerCache[fInput] = true;
                        }
                    }
                    else if( fValue == fConfirm.val() ) {
                        $( 'input[name="password_confirm"]' ).removeClass( 'error' );
                        $( 'input[name="' + fInput + '"]' ).removeClass( 'error' );
                        fConfirm.siblings( '.input-status' ).html( '<i class="icon-black-tick"></i><span>Passwords match</span>' );
                        registerCache[fInput] = true;
                        registerCache['password_confirm'] = true;
                    }
                    else {
                        $( 'input[name="' + fInput + '"]' ).addClass( 'error' );
                        fConfirm.siblings( '.input-status' ).html( '<i class="icon-red-flag"></i><span>Passwords do not match!</span>' );
                        registerCache[fInput] = false;
                    }
                }
            }

            // other
            else {
                // Add an indicator
                $( fStatus ).html( '<img src="' + Redbook.asset_url + 'img/indicator.gif" height="16" width="16" />' );

                validateInput( fInput, fValue, fStatus )
            }


        }, 750 );

        this.lastValue = this.value;

    }
} );

/* Submit input values for validation */
function validateInput( fInput, fValue, fStatus ) {

    if ( validated == null || validated == true || validationAttempts < maxValidationAttempts) intervalValidate();

    $.ajax( {
        url       : Redbook.base_url + 'register.ajax',
        data      : 'action=check_registration&input[' + fInput + ']=' + $.trim( fValue ),
        type      : 'post',
        dataType  : 'json',
        complete  : function () {},
        beforeSend: function () {
            $( fStatus ).html( '<img src="' + Redbook.asset_url + 'img/indicator.gif" height="16" width="16" /><span>checking...</span>' );
        },
        success   : function ( json ) {
            // update registration cache
            registerCache[fInput] = json.status;

            if ( json.status ) {
                $( 'input[name="' + fInput + '"]' ).removeClass( 'error' );
                $( fStatus ).html( '<i class="icon-black-tick"></i><span>' + json.msg + '</span>' );

            }
            else {
                $( 'input[name="'+fInput+'"]' ).addClass( 'error' );
                $( fStatus ).html( '<i class="icon-red-flag"></i><span>' + json.msg + '</span>' );
            }
        }
    } );
}

/* Iterate through input object for any false */
function validateRegistration() {
    validationAttempts++;
    var i = 0;
    $.each( registerCache, function ( k, v ) {
        if ( !registerCache[k] ) return false;
        i++;
    } );

    return validated = !!(i == Object.keys( registerCache ).length);
}

// watch for validated form
function intervalValidate() {
    $('#registration .complete' ).html('<img src="' + Redbook.asset_url + 'img/indicator.gif" />');
    watch_registry_validation( function () {return validateRegistration();}, 2000 );
}

// Interval manager
function watch_registry_validation( proc, int ) {

    if ( timerID ) clearTimeout( timerID );

    timerID = setInterval( function () {
        if ( proc() ) {
            clearTimeout( timerID );
            activateSubmission();
        }
        else if ( validationAttempts >= maxValidationAttempts ) {
            clearTimeout( timerID );
            validationTimeout();
        }
        else {
            $( '#registration .complete' ).html( '' );
            validateRegistration();
        }
    }, int );
}

/* Form passes JS validation */
function activateSubmission() {
    var regSubmit = $('<a href="'+Redbook.base_url+'register.do" class="gButton" id="submitRegistry">Register</a>');

    $( '#registration .complete' ).html( regSubmit );
}

/* Validation watcher ran too long */
function validationTimeout() {
    $('#registration .complete' ).html('');
}

$( d ).on( 'click', '#submitRegistry', function ( event ) {
    event.preventDefault();
    drawerLink = $( this );

    var form = $( '#registration');
    $.ajax( {
        url       : drawerLink.prop( 'href' ),
        data      : getFormInputs( form ),
        type      : 'post',
        dataType  : 'json',
        beforeSend: function () {
            form.find('.complete' ).html( '<img src="' + Redbook.asset_url + 'img/throbber.gif" />' );
        },
        complete  : function () {},
        success   : function ( json ) {
            if ( !json.status ) {
                createNotification( json.level, json.message );
                if ( json.validation ) {
                    $.each( json.validation, function ( index, item ) {
                        if ( typeof item == "object" ) {
                            $.each( item, function ( key, value ) {
                                $( '#f' + key.capitalize() ).addClass('error').siblings( '.input-status' ).text( value );
                            } );
                        }
                    } );
                }
            }
            else {
                drawerLoad( json );
            }
        }
    } );

} );
