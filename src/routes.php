<?php

defined( "REDBOOK_URI" ) or define( "REDBOOK_URI", \Config::get( 'redbook::redbook.routeIndex', null ) . '/' );
/*
|--------------------------------------------------------------------------
| Redbook Routes
|--------------------------------------------------------------------------
*/
Route::get( REDBOOK_URI ,                           array( 'uses' => 'RedbookRootController@index', 'as' => 'redbook' ));

Route::get  ( REDBOOK_URI.'config/global',            'RedbookRootController@config'        );
Route::post ( REDBOOK_URI.'config/global',            'RedbookRootController@configUpdate'  );

/*
|--------------------------------------------------------------------------
| Package Routes
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Database Routes
|--------------------------------------------------------------------------
*/
Route::resource ( REDBOOK_URI.'databases',                'RedbookDatabaseController');
//Route::get( REDBOOK_URI.'databases/{database}',     'RedbookDatabaseController@activate'    );
Route::get(REDBOOK_URI.'state', 'RedbookDatabaseController@state');

Route::get( REDBOOK_URI.'schema/{key}',             'RedbookDatabaseController@readSchema');
Route::get( REDBOOK_URI.'key/{key}' ,               'RedbookDatabaseController@readKey'     );
Route::get( REDBOOK_URI.'edit/{database}/{key}',    'RedbookDatabaseController@editKey'     );
Route::delete( REDBOOK_URI.'key.delete',            'RedbookDatabaseController@deleteKey'   );

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
*/
Route::post( REDBOOK_URI . 'call',     'RedbookConsoleController@call');
