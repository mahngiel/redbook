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
        catch ( \Reeck\Redbook\Exceptions\RedisKeyException $exception )
        {
            $this->data['error'] = $exception->getMessage();
        }

        $this->data['schema']  = $schema;
        $this->data['Objects'] = $Objects;

        $this->layout->content = \View::make( FRONTEND . $this->_ViewDir . '.schema', $this->data );
    }
}
