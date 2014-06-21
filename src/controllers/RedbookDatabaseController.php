<?php

use Reeck\Redbook\Support\RedisReader;

class RedbookDatabaseController extends RedbookBaseController {

    public function activate( $databaseName )
    {
        \Session::put('activeDatabase', $databaseName);

        if( !\Request::ajax() )
        {
            return Redirect::route('redbook');
        }

        $RedisReader = new RedisReader( $databaseName );

        $this->data['Objects'] = mapRedisSchema( $RedisReader->findAllStoresForDatabase(), \Config::get( 'redbook::redbook.schemaSeparator' ) );

        return View::make( MODULE . 'schema', $this->data );
    }
} 
