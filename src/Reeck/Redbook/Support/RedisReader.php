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
        foreach ($this->keys( "{$prefix}*" ) as $key)
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
} 
