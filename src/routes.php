<?php

/*
|--------------------------------------------------------------------------
| Redbook Routes
|--------------------------------------------------------------------------
*/
defined("REDBOOK_URI") or define( "REDBOOK_URI", \Config::get('redbook::redbook.routeIndex', null) . '/' );

\Route::get( REDBOOK_URI , array( 'uses' => 'RedbookRootController@index', 'as' => 'redbook' ));
\Route::get( REDBOOK_URI.'key/{key}' , 'RedbookRootController@readKey');

\Route::get( REDBOOK_URI.'database/{database}', 'RedbookDatabaseController@activate' );
