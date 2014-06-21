<?php

class RedbookRootController extends RedbookBaseController {

    /**
     * @var string
     */
    protected $_ViewDir = 'redis';

    /**
     * @param Reeck\\Redbook\Support\RedisReader $Provider
     */
    public function __construct( \Reeck\Redbook\Support\RedisReader $Provider )
    {
        parent::__construct();
        $this->_Provider = $Provider;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try
        {


            $this->data['Database'] = $this->_Provider->getDatabaseInformation();
        }
        catch ( \Predis\Connection\ConnectionException $e )
        {
            $this->data['Alert'] = $e->getMessage();
        }

        $this->layout->content = \View::make( FRONTEND . $this->_ViewDir . '.index', $this->data );
    }

    /**
     * Display the specified resource.
     *
     * @param  int $database
     *
     * @return Response
     */
    public function read()
    {
        $this->data['Objects'] = $this->_Provider->getAllKeysForDatabase();

        $this->layout->content = View::make( BACKEND . $this->_ViewDir . '.view', $this->data );
    }

    public function readKey( $key )
    {
        $this->data['Object'] = $this->_Provider
            ->getValueByKeyName( $key );

        $this->layout->content = View::make( FRONTEND . $this->_ViewDir . '.key', $this->data );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Response
     */
    public function tasks()
    {
        $this->layout->content = View::make( BACKEND . $this->_ViewDir . '.tasks', $this->data );
    }

    /**
     *
     */
    public function perform()
    {
        foreach (Input::get( 'tasks' ) as $actionType => $val)
        {
            $this->{$actionType}();
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    private function cleanDownloads()
    {
        // Fetch all keypad stores
        $downloads = array();

        // Grab all the stores from keypad db
        foreach ($this->_Provider->findAllStoresForDatabase( 'Metrics' ) as $store)
        {
            // grab download types
            if (preg_match( "/downloads:(\w*)/", $store ))
            {
                array_push( $downloads, $store );
            }
        }

        // purge them
        $this->_Provider->Metrics->del( $downloads );

        return Redirect::to( 'redis' )->with( 'message', 'Removed ' . count( $downloads ) . ' download keys' );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update( $id )
    {
        //
        parent::update( $id );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy( $id )
    {
        //
        parent::destroy( $id );
    }
}
