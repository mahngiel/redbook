<?php namespace Mahngiel\Redbook\Modules\Modules;

use Mahngiel\Modules\Modules;
use Mahngiel\Redbook\DatabaseManager;
use Mahngiel\Redbook\Support\RedisReader;
use Predis\Connection\ConnectionException;

class Index_Module extends Modules {

    public $name = 'Index';
    public $description = 'Maintains the keys within the redis database';
    public $author = 'Redbook Development';
    public $link = 'http://redbook.io';
    public $version = '0.1.0';
    public $own_database = false;
    public $change_database = false;
    public $settings = array(
        'title' => array(
            'type'        => 'text',
            'name'        => 'title',
            'label'       => 'Page Title',
            'description' => 'The page title will appear in the navigation menu',
            'required'    => true,
            'value'       => 'Custom Link',
            'validation'  => 'required'
        ),
    );

    /**
     * Init
     *
     * Initialize the module
     *
     * @param $module_name
     *
     * @return bool
     */
    public function start( $module_name )
    {
        // Validate data
        if (!$Module = parent::retrieveModule( $module_name ))
        {
            return false;
        }

        // Assign module overrides
        foreach (unserialize( $Module->settings ) as $key => $value)
        {
            $this->settings[$key]['value'] = $value;
        }

        // run module logic
        $this->run();
    }

    public function run()
    {
        $DB = new DatabaseManager();

        $this->data['databases'] = $DB->getDatabaseNames();

        // Retrieve active database
        $activeDatabase = $DB->getActiveDatabase();

        // Map its schema
        $this->data['Objects'] = $activeDatabase->mapRedisSchema();

        parent::rawContainer( MODULE . 'index', $this->data );
    }
}
