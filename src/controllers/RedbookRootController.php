<?php

class RedbookRootController extends RedbookBaseController {

    /**
     * @param Reeck\\Redbook\Support\RedisReader $Provider
     */
    public function __construct( \Mahngiel\Redbook\Support\RedisReader $Provider )
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
        $this->layout->content = \View::make( PACKAGE . '.index', $this->data );
    }

    /**
     * Show view to manage global configuration file
     *
     * @return \Illuminate\View\View
     */
    public function config()
    {
        // Retrieve global redbook config
        $this->data['configs'] = \Config::get('redbook::redbook');

        return \View::make(PACKAGE . 'config.global', $this->data );
    }

    /**
     * Store config option rules
     *
     * todo abstract for various framework config methods
     */
    public function configUpdate()
    {
        // validate config changes

        // escape backslashes

        // write config
        Colophon::generateConfig('redbook.php', Input::all());

        // redirect to routeIndex
    }

}
