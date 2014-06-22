<?php

class RedbookConsoleController extends RedbookBaseController {

    /**
     * @param Mahngiel\Redbook\Support\RedisReader $Provider
     */
    public function __construct( \Mahngiel\Redbook\Support\RedisReader $Provider )
    {
        parent::__construct();

        $this->_Provider = $Provider;
    }

    public function call()
    {
        try
        {
            $response = $this->_Provider->fire( Input::get('command') );
        }
        catch( \Predis\ServerException $exception )
        {
            $response = $exception->getMessage();
        }

        debug($response);
    }
} 
