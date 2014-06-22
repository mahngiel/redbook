<?php namespace Mahngiel\Redbook\Support;

class RedisConsole {

    private $serverCommands = array(
        'bgrewriteaof',
        'bgsave',
        'client kill',
        'client list',
        'client getname',
        'client pause',
    );

    public function __construct( $command )
    {

    }
} 
