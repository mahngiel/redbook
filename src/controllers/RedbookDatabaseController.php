<?php

use Reeck\Redbook\Support\RedisReader;

class RedbookDatabaseController extends RedbookBaseController {

    /**
     * @param Reeck\\Redbook\Support\RedisReader $Provider
     */
    public function __construct( \Reeck\Redbook\Support\RedisReader $Provider )
    {
        parent::__construct();

        $this->_Provider = $Provider;
    }

    public function activate( $databaseName )
    {
        \Session::put( 'activeDatabase', $databaseName );

        if (!\Request::ajax())
        {
            return Redirect::route( 'redbook' );
        }

        $RedisReader = new RedisReader( $databaseName );

        $this->data['Objects'] = mapRedisSchema( $RedisReader->findAllStoresForDatabase(), \Config::get( 'redbook::redbook.schemaSeparator' ) );

        return View::make( MODULE . 'schema', $this->data );
    }

    public function readKey( $key )
    {
        try
        {
            $this->data['Object'] = $this->_Provider->getValueByKeyName( $key );

            $View = \View::make( FRONTEND . $this->_ViewDir . "redis.types.{$this->data['Object']['type']}", $this->data );
        }
        catch ( \Reeck\Redbook\Exceptions\RedisKeyException $exception )
        {
            $View = \View::make( FRONTEND . $this->_ViewDir . '.error', array( 'error' => $exception->getMessage() ) );
        }

        if (Request::ajax())
        {
            return $View;
        }
        else
        {
            $this->layout->content = $View;
        }
    }

    public function deleteKey()
    {
        if (!Input::has( 'database' ) || !Input::has( 'keyName' ))
        {
            return Response::json( $this->response );
        }

        $this->_Provider->loadDatabase( Input::get( 'database' ) );

        if (!$this->_Provider->exists( Input::get( 'keyName' ) ))
        {
            return Response::json( $this->response );
        }

        $this->_Provider->del( Input::get( 'keyName' ) );

        $this->response = array(
            'status'   => true,
            'message'  => Input::get( 'keyName' ) . ' deleted successfully',
            'level'    => 'success',
            'redirect' => URL::route( 'redbook' )
        );

        return Response::json( $this->response );
    }

    public function editKey( $databaseName, $keyName )
    {
        \Session::put( 'activeDatabase', $databaseName );

        $this->_Provider->loadDatabase( $databaseName );

        $this->data             = $this->_Provider->getValueByKeyName( $keyName );
        $this->data['database'] = $databaseName;


        return View::make( FRONTEND . '.redis.modals.keyEdit', $this->data );
    }
} 
