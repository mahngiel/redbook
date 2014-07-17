/**
 * Redbook.
 * @author: kreeck
 * Date: 7/16/14
 * Time: 11:50 PM
 */

angular.module( 'dbController', [] ).controller( 'DatabaseController', function ( $scope, $http, Database ) {
    $scope.databaseConfigs = {};
    $scope.databases = [];

    $scope.loading = true;

    // Get all dbs
    Database.get().success( function ( data ) {
        $scope.databases = data;
        $scope.loading = false;

        // find active database
        $.each( data, function ( k, v ) {
            if ( v.active ) {
                // assign activeDB
                $scope.activeDatabase = v.name;

                // retrieve db schema
                $scope.activeDatabaseSchema = Database.view( v.name ).success( function ( data ) {
                    //                        console.log( data );
                } ).error( function ( data ) {
                    console.log( data );
                } );

                // break loop
                return;
            }
        } );
    } );

    $scope.submitDatabaseConfig = function () {
        $scope.loading = true;

        Database.save( $scope.databaseConfig ).success( function ( database ) {
            Database.get().success( function ( data ) {
                $scope.databases = data;
                $scope.loading = false;
            } );
        } ).error( function ( data ) {
            console.log( data );
        } );
    };

    $scope.deleteDatabaseConfig = function ( databaseName ) {
        $scope.loading = true;

        Database.destroy( databaseName ).success( function ( data ) {
            $scope.databases = data;
            $scope.loading = false;
        } ).error( function ( data ) {
            console.log( data );
        } );
    };
} );

angular.module( 'schemaController', [] ).controller( 'SchemaController', function ( $scope, $http, Database, Redis ) {

    Redis.status().success( function ( data ) {
            $scope.activeDatabaseState = data;
        } ).error( function ( data ) {
            console.log( 'error: ' + data );
        } );
} );

