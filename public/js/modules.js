/**
 * Grizzly.
 * @author: kreeck
 * Date: 7/26/13
 * Time: 12:43 AM
 */

var tempCache = [];

$( d ).on( 'click', '#createModuleArea', function () {
    var token = $.token( 5, false );
    tempCache[token] = token;
    $( '#moduleareas' ).append( '<tbody id="' + token + '">' + '<tr>' + '<td><i class="icon-black-cross deleteNewArea" data-id="' + token + '" title="delete this area"></i>' + '<input type="text" name="area" class="newAreaField"/></td>' + '<td><em>Create a name for your new Area</em></td>' + '</tr></tbody>' );
} );

$( d ).on( 'click', '.deleteNewArea', function () {
    var owner = $(this ).closest('tbody');
    tempCache.splice(owner.attr('id'));

    owner.fadeOut( 250, function () { $( this ).remove() } );
} );

$( d ).on( 'click', '.installArea', function ( event ) {
    event.preventDefault();
    owner = $( this ).closest( 'tbody' );

    if( tempCache[owner.attr( 'id' )] == 'validated' ) {
        saveNewArea( owner, owner.attr('id') );
    }
} );

$( d ).on( 'keyup', '.newAreaField', function () {
    var fInput = $( this );

    // Ensure value has changed
    if ( this.value !== this.lastValue && this.value.trim() !== this.lastValue ) {

        if ( this.timer ) clearTimeout( this.timer );

        this.timer = setTimeout( function () {

            // Fire!
            validateNewArea( fInput, fInput.closest( 'tbody' ).attr( 'id' ) );

        }, 500 );

        this.lastValue = this.value;
    }
} );

function validateNewArea( input, id ) {
    var ele = $( '#' + id ), msg = ele.find( 'em' );

    $.ajax( {
        url       : Redbook.base_url + 'admin/modules/validateArea',
        data      : 'name=' + input.val(),
        type      : 'post',
        dataType  : 'json',
        beforeSend: function () {
            msg.html( '<img src="' + Redbook.asset_url + 'img/indicator.gif" /> Checking on that for you' );
        },
        complete  : function () {
        },
        success   : function ( json ) {
            if ( json.status ) {
                msg.html( json.message + ' <a href="' + Redbook.base_url + 'admin/modules/createArea" class="installArea gButton">Save</a>' );
                tempCache[id] = 'validated';
            }
            else {
                msg.html( json.validation.name + ' <i class="icon-black-flag"></i>' );
            }
        }
    } );
}

function saveNewArea( owner, id ) {
    var ele = $( '#' + id ), msg = ele.find( 'em' );

    $.ajax( {
        url       : Redbook.base_url + 'admin/modules/createArea',
        data      : 'name=' + owner.find('input').val(),
        type      : 'post',
        dataType  : 'json',
        beforeSend: function () {
            owner.find('em').html( '<img src="' + Redbook.asset_url + 'img/indicator.gif" /> Save in progress... ' );
        },
        complete  : function () {
        },
        success   : function ( json ) {
            if ( json.status ) {

                tempCache.splice( owner.attr( 'id' ) );
                owner.fadeOut( 250, function () { $( this ).remove() } );

                var newEle = $( '#moduleareas' ).find( '.owner' ).last().clone();
                newEle.attr( 'data-id', 'area' + json.object.id );
                newEle.find( 'i' ).attr( 'title', 'delete ' + json.object.name );
                newEle.find( 'span' ).text( json.object.name );
                newEle.appendTo( $('#moduleareas') ).fadeIn(250);
            }
            else {
                msg.html( json.message + ' <i class="icon-black-flag"></i>' );
            }
        }
    } );
}

