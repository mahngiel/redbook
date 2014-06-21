<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis'       => array(

        'cluster' => false,

        'default' => array(
            'host'     => '127.0.0.1',
            'port'     => 1666,
            'database' => 0,
            'password' => 'devicevault'
        ),
        'metrics' => array(
            'host'     => '127.0.0.1',
            'port'     => 1666,
            'database' => 1,
            'password' => 'devicevault'
        ),
        'redbook' => array(
            'host'     => '127.0.0.1',
            'port'     => 2245,
            'database' => 0,
            'password' => 'redbook'
        )

    ),

);
