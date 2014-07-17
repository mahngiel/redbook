/**
 * Redbook.
 * @author: kreeck
 * Date: 7/16/14
 * Time: 11:51 PM
 */

angular.module( 'dbService', [] ).factory( 'Database', function ( $http ) {

    return {
        get: function () {
            return $http.get( Redbook.baseUrl + 'databases' );
        },

        save: function ( databaseConfig ) {
            return $http( {
                method : 'post',
                url    : Redbook.baseUrl + 'databases',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data   : $.param( databaseConfig )
            } );
        },

        view: function ( databaseName ) {
            return $http.get( Redbook.baseUrl + 'databases/' + databaseName );
        },

        destroy: function ( databaseName ) {
            return $http.delete( Redbook.baseUrl + 'databases/' + databaseName );
        }
    }
} );

angular.module( 'redisService', [] ).factory( 'Redis', function ( $http ) {

    return {
        status: function () {
            return $http.get( Redbook.baseUrl +'state');
        }
    }
} );
