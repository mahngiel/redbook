<?php

use Mahngiel\Redbook\Support\RedisReader;

/**
 * Class RedbookDatabaseController
 */
class RedbookDatabaseController extends RedbookBaseController {

    /**
     * @param Reeck\\Redbook\Support\RedisReader $Provider
     */
    public function __construct( \Mahngiel\Redbook\Support\RedisReader $Provider )
    {
        parent::__construct();

        $this->_Provider = $Provider;
    }

    /**
     * Show active database summary
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $databases = array();

        try
        {
            $DB        = new \Mahngiel\Redbook\DatabaseManager();
            $databases = array_map( function ( $database )
            {
                return array(
                    'name'   => $database,
                    'active' => ( \Session::get( 'activeDatabase' ) === $database ? 1 : 0 )
                );
            }, $DB->getDatabaseNames() );
        }
        catch ( \Exception $exception )
        {
        }

        return Response::json( $databases );
    }

    /**
     * Create database record
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $View = \View::make( PACKAGE . 'config.create', $this->data );
        if( \Request::ajax() )
        {
            return $View;
        }
        else
        {
            return $this->layout->content = $View;
        }
    }

    /**
     * @param $databaseName
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show( $databaseName )
    {
        \Session::put( 'activeDatabase', $databaseName );

        //if (!\Request::ajax()) { return Redirect::route( 'redbook' ); }

        $this->data['Object'] = new RedisReader( $databaseName );

        return View::make( MODULE . 'schema', $this->data );
    }

    /**
     * Store database configuration
     */
    public function store()
    {
        // validate parameters
        $database = array(
            Input::get( 'name' ) => array(
                'host'     => Input::get( 'host' ),
                'port'     => Input::get( 'port' ),
                'password' => Input::get( 'password', '' ),
                'database' => Input::get( 'database' )
            )
        );

        // attempt to connect to database
        $Redis = new \Illuminate\Redis\Database( $database );
        $test = $Redis->connection(Input::get('name'));

        try {
            $test->info();
        }
        catch ( \Predis\Connection\ConnectionException $exception )
        {
            \Session::flash('error', sprintf("Unable to connect to database. \n Received error %s. \n\n Save configuration anyway?", $exception->getMessage() ));

            $this->response['redirect'] = \URL::to( REDBOOK_URI . 'databases/create');

            return \Response::json($this->response);
        }

        // confirm for failure

        // write to file

        debug( Input::all() );
    }

    /**
     * Display active database summary
     *
     * @return Response
     */
    public function state()
    {
        try
        {
            $this->data['Database'] = $this->_Provider->getDatabaseInformation();
        }
        catch ( \Predis\Connection\ConnectionException $e )
        {
            $this->data['Alert'] = $e->getMessage();
        }

        return \View::make( PACKAGE . '.database', $this->data );
    }

    /**
     * @param $key
     *
     * @return \Illuminate\View\View
     */
    public function readKey( $key )
    {
        try
        {
            $this->data['Object'] = $this->_Provider->getValueByKeyName( $key );

            $View = \View::make( PACKAGE . "types.{$this->data['Object']['type']}", $this->data );
        }
        catch ( \Mahngiel\Redis\Exceptions\RedisKeyException $exception )
        {
            $View = \View::make( PACKAGE . '.error', array( 'error' => $exception->getMessage() ) );
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

    /**
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * @param $databaseName
     * @param $keyName
     *
     * @return \Illuminate\View\View
     */
    public function editKey( $databaseName, $keyName )
    {
        \Session::put( 'activeDatabase', $databaseName );

        $this->_Provider->loadDatabase( $databaseName );

        $this->data             = $this->_Provider->getValueByKeyName( $keyName );
        $this->data['database'] = $databaseName;


        return View::make( FRONTEND . 'modals.keyEdit', $this->data );
    }

    /**
     * @param $schema
     */
    public function readSchema( $schema )
    {
        try
        {
            $Objects = array();

            foreach ($this->_Provider->findKeysByPrefix( $schema ) as $key)
            {
                $Objects[] = generateHtmlSnippet( $this->_Provider->getValueByKeyName( $key ) );
            }
        }
        catch ( \Mahngiel\Redis\Exceptions\RedisKeyException $exception )
        {
            $this->data['error'] = $exception->getMessage();
        }

        $this->data['schema']  = $schema;
        $this->data['Objects'] = $Objects;

        $this->layout->content = \View::make( PACKAGE . 'schema', $this->data );
    }
} 
