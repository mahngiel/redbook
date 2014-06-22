<?php

class RedbookRootController extends RedbookBaseController {

    /**
     * @param Reeck\\Redbook\Support\RedisReader $Provider
     */
    public function __construct( \Reeck\Redbook\Support\RedisReader $Provider )
    {
        parent::__construct();

        $this->_Provider = $Provider;
    }
}
