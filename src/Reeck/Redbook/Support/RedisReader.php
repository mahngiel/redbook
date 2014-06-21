<?php namespace Reeck\Redbook\Support;

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
     * @param $keyName
     *
     * @return mixed
     * @throws \Exception
     */
    public function getValueByKeyName( $keyName )
    {
        if (!$this->exists( $keyName ))
        {
            throw new \Exception( 'Key not found' );
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
                $var = json_encode( $this->hgetall( $key ) );
                break;
            case 'set':
                $var = implode( ', ', $this->smembers( $key ) );
                break;
            case 'list':
                $count = $this->llen( $key );
                $var   = implode( ', ', $this->lrange( $key, 0, ( $count - 1 ) ) );
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
