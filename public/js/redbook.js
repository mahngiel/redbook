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
    var schemaChangeTarget = '#redbook-schema', databaseListContainer = '#redbook-databases', schemaTreeItem = '.schema-key', pageWait = $( '<div id="wait"><img src="' + Redbook.assetUrl + 'img/preloader.gif" /></div>' ), navRoot = $( '#page' ), navTarget = $( '#page' ), navLink = null;

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
        navLink.closest( 'li' ).addClass( 'active' );
        navTarget.load( navLink.prop( 'href' ), function () {mapAvailableSchema();} );
        history.pushState( null, null, navLink.prop( 'href' ) );
    } );

    /**
     * Schema key change
     */
    $( d ).on( 'click', 'a.ajaxSchemaKey', function ( event ) {
        event.preventDefault();
        $( schemaTreeItem + '.active' ).removeClass( 'active' );
        navTarget = $( schemaChangeTarget );
        navTarget.prepend( pageWait );
        navLink = $( this );
        navLink.parent( schemaTreeItem ).addClass( 'active' );
        $( '#page' ).load( navLink.prop( 'href' ) );
        history.pushState( null, null, navLink.prop( 'href' ) );
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

        var fly = $( '<div/>', {id: 'flyIn'} ).load( $( this ).prop( 'href' ) ).prependTo( navTarget ).effect( 'fadeIn', 'slow' );
    } );

    /* -------------------------------- OBJECT REQUEST OPERATIONS --------------------------------------- */
    $( d ).on( 'click', 'a.ajaxRequest', function ( event ) {
        event.preventDefault();
        navLink = $( this );
        var doLoad = true;

        $.ajax( {
            url        : navLink.prop( 'href' ), type: 'get', dataType: 'json', beforeSend: function () {
                navTarget.prepend( pageWait );
            }, complete: function () {
                $( '#loading' ).remove();
                if ( doLoad ) {
                    navTarget.load( navLink.prop( 'href' ) );
                    history.pushState( null, null, navLink.prop( 'href' ) );
                }
            }, success : function ( json ) {
                if ( !json.status ) {
                    Redbook.createNotification( json.level, json.message );
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
                method: 'POST', action: navLink.prop( 'href' ), id: 'delForm'
            } ).append( '<input type="hidden" name="_method" value="DELETE"/>' ).append( '<input type="hidden" name="keyName" value="' + navLink.closest( '#key-options' ).attr( 'data-key' ) + '"/>' ).append( '<input type="hidden" name="database" value="' + navLink.closest( '#key-options' ).attr( 'data-database' ) + '"/>' ) );

            form = $( '#delForm' );

            $.ajax( {
                url       : form.prop( 'action' ),
                data      : getFormInputs( form ),
                type      : 'post',
                dataType  : 'json',
                beforeSend: function () { },
                complete  : function () {
                    form.remove();
                },
                success   : function ( json ) {
                    Redbook.createNotification( json.level, json.message );
                    if ( !json.status ) {
                    }
                    else {
                        if ( json.redirect ) {
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

                                var fly = $( '<div/>', {id: 'flyIn'} ).load( $( this ).prop( 'href' ) ).prependTo( navTarget ).effect( 'fadeIn', 'slow' );
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
                                        method: 'POST', action: navLink.prop( 'href' ), id: 'delForm'
                                    } ).append( '<input type="hidden" name="_method" value="DELETE"/>' ).append( '<input type="hidden" name="keyName" value="' + navLink.closest( '#key-options' ).attr( 'data-key' ) + '"/>' ).append( '<input type="hidden" name="database" value="' + navLink.closest( '#key-options' ).attr( 'data-database' ) + '"/>' ) );

                                    form = $( '#delForm' );

                                    $.ajax( {
                                        url       : form.prop( 'action' ),
                                        data      : getFormInputs( form ),
                                        type      : 'post',
                                        dataType  : 'json',
                                        beforeSend: function () { },
                                        complete  : function () {
                                            form.remove();
                                        },
                                        success   : function ( json ) {
                                            createNotification( json.level, json.message );
                                            if ( !json.status ) {
                                            }
                                            else {
                                                if ( json.redirect ) {
                                                    //                        navTarget.load( json.redirect );
                                                    //                        history.pushState( null, null, json.redirect );
                                                    location.replace( json.redirect );
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
                                        Redbook.createNotification( json.level, json.message );

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

                            //                        navTarget.load( json.redirect );
                            //                        history.pushState( null, null, json.redirect );
                            location.replace( json.redirect );
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

/**
 * Database
 */
(function(){
    var app = angular.module('redbook', []);

    /** Database controller **/
    app.controller('DatabaseController', ['$http', function($http){
        var databases = this;
        databases.available = [];

        // retrieve database listing
        $http.get( Redbook.baseUrl + 'databases' ).success(function(data) {
            databases.available = data;
        });
    }]);

    /** Schema controller **/
    app.controller( 'SchemaController', ['$http', function ( $http ) {
        var schema = this;
        schema.available = [];

        // retrieve schema tree
        $http.get( Redbook.baseUrl + 'databases' ).success( function ( data ) {
            schema.available = data;
        } );
    }] );


})();
