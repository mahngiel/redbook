<?php namespace Reeck\Redbook\Support;

use Reeck\Redbook\Exceptions\RedisKeyException;
use Reeck\Redbook\Exceptions\RedisSchemaException;

/**
 * Class RedisReader
 *
 * @package Redbook\Support
 */
class RedisReader extends Redis {

    /**
     * @param null $database
     */
    public function __construct( $database = null )
    {
        parent::__construct();

        $this->database = $database ? : \Session::get( 'activeDatabase', 'default' );
    }

    /**
     * @param $database
     *
     * @return $this
     */
    public function loadDatabase( $database )
    {
        $this->database = $database;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDatabaseInformation()
    {
        return $this->info();
    }

    /**
     * @return array
     */
    public function getAllKeysForDatabase()
    {
        $data = array();

        // read through each key
        foreach ($this->keys( '*' ) as $key)
        {
            // store the key type
            $data[$key]['name']  = $key;
            $data[$key]['type']  = $this->type( $key );
            $data[$key]['value'] = $this->unpackKeyType( $data[$key]['type'], $key );
        }

        ksort( $data );

        return $data;
    }

    /**
     * @return array
     */
    public function findAllStoresForDatabase()
    {
        $data = array();

        // read through each key
        foreach ($this->keys( '*' ) as $key)
        {
            // store the key type
            $data[] = $key;
        }

        natcasesort( $data );

        return $data;
    }

    /**
     * @param $prefix
     *
     * @return array
     */
    public function findKeysByPrefix( $prefix )
    {
        $data = array();

        // read through each key
        foreach ($this->keys( "{$prefix}:*" ) as $key)
        {
            // store the key type
            $data[] = $key;
        }

        natcasesort( $data );

        return $data;
    }

    /**
     * @param $keyName
     *
     * @return mixed
     * @throws \Exception
     */
    public function getValueByKeyName( $keyName )
    {
        if (!$this->exists( $keyName ))
        {
            throw new RedisKeyException( "Requested key \"{$keyName}\" not found" );
        }

        $data['name']  = $keyName;
        $data['type']  = $this->type( $keyName );
        $data['value'] = $this->unpackKeyType( $data['type'], $keyName );
        $data['ttl']   = $this->ttl( $keyName );

        return $data;
    }

    /**
     * @param $type
     * @param $key
     *
     * @return null|string
     */
    private function unpackKeyType( $type, $key )
    {
        $var = null;
        switch ($type)
        {
            case 'string':
                $var = $this->get( $key );
                break;
            case 'hash':
                $var = $this->hgetall( $key );
                break;
            case 'set':
                $var = $this->smembers( $key );
                break;
            case 'list':
                $var = $this->lrange( $key, 0, -1 );
                break;
            case 'zset':
                $var = $this->zrange( $key, 0, -1, 'withscores' );
        }

        return $var;
    }

    /**
     * @return mixed
     */
    public function getDatabaseSize()
    {
        return $this->dbsize();
    }

    /**
     * @param $command
     *
     * @return mixed
     * @throws \RedisException
     */
    public function fire( $command )
    {
        // chunk and trim
        $commandArgs = array_map( function ( $arg ) { return trim( $arg ); }, explode( ' ', $command ) );

        if (empty( $commandArgs ))
        {
            throw new \RedisException( 'No command issued' );
        }

        $command = array_shift( $commandArgs );

        switch (count( $commandArgs ))
        {
            case 0:
                $r = $this->{$command}();
                break;
            case 1:
                $r = $this->{$command}( $commandArgs[0] );
                break;
            case 2:
                $r = $this->{$command}( $commandArgs[0], $commandArgs[1] );
                break;
            case 3:
                $r = $this->{$command}( $commandArgs[0], $commandArgs[1], $commandArgs[2] );
                break;
            case 4:
                $r = $this->{$command}( $commandArgs[0], $commandArgs[1], $commandArgs[2], $commandArgs[3] );
                break;
        }

        return $r;
    }
} 
