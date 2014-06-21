<?php

/*
|--------------------------------------------------------------------------
| Redbook Routes
|--------------------------------------------------------------------------
*/
defined("REDBOOK_URI") or define( "REDBOOK_URI", \Config::get('redbook::redbook.routeIndex', null) . '/' );

Route::get( REDBOOK_URI , 'RedbookRootController@index');
