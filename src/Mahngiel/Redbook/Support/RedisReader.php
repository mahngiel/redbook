<?php namespace Mahngiel\Redbook\Support;

use Illuminate\Support\Contracts\ArrayableInterface;
use Illuminate\Support\Contracts\JsonableInterface;
use Mahngiel\Redbook\Markup\Writer;
use Mahngiel\Redis\Exceptions\RedisKeyException;
use Mahngiel\Redis\Exceptions\RedisSchemaException;
use Mahngiel\Redis\Redis;

/**
 * Class RedisReader
 *
 * @package Redbook\Support
 */
class RedisReader extends Redis implements ArrayableInterface, JsonableInterface {

    public $namespaceSeparator = ':';

    public $dataStores = array();

    /**
     * @param null $database
     */
    public function __construct( $database = null )
    {
        parent::__construct();

        $this->database = $database ? : \Session::get( 'activeDatabase', 'default' );

        $this->setNamespaceSeparator( \Config::get("redbook::{$database}.namespace", ':') );
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
        if( !empty($this->dataStores) )
        {
            return $this->dataStores;
        }

        $this->dataStores = $this->keys('*');

        natcasesort($this->dataStores);

        return $this->dataStores;
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

    /**
     * @param null $separator
     */
    public function setNamespaceSeparator( $separator = ':' )
    {
        $this->namespaceSeparator = $separator;
    }

    /**
     * @return string
     */
    public function getNamespaceSeparator()
    {
        return $this->namespaceSeparator;
    }

    /**
     * Combine namespace strings into arrays
     *
     * foo:bar = [foo => [bar] ]
     *
     * @param array  $namespaces
     * @param string $separator
     *
     * @return array
     */
    public function mapRedisSchema()
    {
        $namespaces = $this->findAllStoresForDatabase();

        // create container for keys
        $container = array();

        // iterate through each key
        foreach ($namespaces as $namespace)
        {
            // break up by the namespace
            $path = explode( $this->getNamespaceSeparator(), $namespace );

            // create a copy of the container
            $root = & $container;

            // cache last key
            $value = last( $path );

            // glue the element to its predecessor
            while (count( $path ) > 1)
            {
                // take the top key
                $branch = array_shift( $path );

                // make this key an array if not exists
                if (!isset( $root[$branch] ))
                {
                    $root[$branch] = array();
                }

                // and attach it to it's predecessor
                $root = & $root[$branch];
            }

            if( is_string($root) ) continue;

            // add the final piece back on
            $root[] = $value;
        }

        return $container;
    }

    /**
     * Generate HTML presentation of schema
     *
     * @return string
     */
    public function generateTreeHtml()
    {
        $htmlWriter = new Writer();

        return $htmlWriter->render( $this->mapRedisSchema(), $this->getNamespaceSeparator() );
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->findAllStoresForDatabase();
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int $options
     *
     * @return string
     */
    public function toJson( $options = 0 )
    {
        return json_encode( $this->findAllStoresForDatabase(), JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
    }
}
