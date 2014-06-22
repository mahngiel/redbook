<?php namespace Reeck\Redbook\Modules\Modules;

use Reeck\Redbook\Modules\Modules;
use Reeck\Redbook\Support\RedisReader;

class Console_Module extends Modules {

    public $name = 'Console';
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
        // Add console script to DOM
        \Colophon::addScriptToFooter('App_Console', 'js/console.js');

        parent::rawContainer( MODULE . 'console', $this->data );
    }
}
