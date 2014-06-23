<?php namespace Mahngiel\Redbook;  

use Mahngiel\Redbook\Support\RedisReader;

class DatabaseManager {

    public $namespaceSeparator = ':';

    public function getDatabases()
    {
        return \Config::get('redbook::databases');
    }

    public function getDatabaseNames()
    {
        return array_keys($this->getDatabases());
    }

    public function setActiveDatabase( $databaseName )
    {
        if( !in_array($databaseName, $this->getDatabaseNames()) )
        {
            return false;
        }

        \Session::set('activeDatabase', $databaseName);
    }

    /**
     * @return RedisReader
     */
    public function getActiveDatabase()
    {
        return new RedisReader( \Session::get('activeDatabase') );
    }

    public function setNamespaceSeparator( $separator = null )
    {
        $this->namespaceSeparator = $separator?: \Config::get( 'redbook::redbook.schemaSeparator' );
    }

    public function getNamespaceSeparator()
    {
        return $this->namespaceSeparator;
    }
} 
