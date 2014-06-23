<?php
/*
|--------------------------------------------------------------------------
| Redbook Routes
|--------------------------------------------------------------------------
*/
defined("REDBOOK_URI") or define( "REDBOOK_URI", \Config::get('redbook::redbook.routeIndex', null) . '/' );

//Route::get( REDBOOK_URI ,                           array( 'uses' => 'RedbookRootController@index', 'as' => 'redbookHome' ));

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
Route::get( REDBOOK_URI ,                           array( 'uses' => 'RedbookDatabaseController@index', 'as' => 'redbook' ));
Route::get( REDBOOK_URI.'schema/{key}',             'RedbookDatabaseController@readSchema');
Route::get( REDBOOK_URI.'database/{database}',      'RedbookDatabaseController@activate'    );
Route::get( REDBOOK_URI.'key/{key}' ,               'RedbookDatabaseController@readKey'     );
Route::get( REDBOOK_URI.'edit/{database}/{key}',    'RedbookDatabaseController@editKey'     );
Route::delete( REDBOOK_URI.'key.delete',            'RedbookDatabaseController@deleteKey'   );

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
*/
Route::post( REDBOOK_URI . 'call',     'RedbookConsoleController@call');
