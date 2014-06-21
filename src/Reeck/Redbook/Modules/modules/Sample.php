<?php namespace Redbook\Module;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Redbook\Modules\Modules;

class Sample_Module extends Modules
{
    public $name = 'Pages';
    public $description = 'Create custom pages and navbar links';
    public $author = 'Redbook Development';
    public $link = 'http://redbook.io';
    public $version = '1.0';
    public $own_database = FALSE;
    public $change_database = FALSE;
    public $settings = array(
        'title'      => array(
            'type'        => 'text',
            'name'        => 'title',
            'label'       => 'Page Title',
            'description' => 'The page title will appear in the navigation menu',
            'required'    => TRUE,
            'value'       => 'Custom Link',
            'validation'  => 'required'
        ),
        'content'    => array(
            'type'        => 'textarea',
            'name'        => 'content',
            'label'       => 'Page content',
            'description' => 'Use the code editor to create a custom page',
            'required'    => TRUE,
            'value'       => 'Custom page.',
            'validation'  => 'required|alpha_dash|min:2'
        ),
        'visibility' => array(
            'type'        => 'dropdown',
            'name'        => 'visibility',
            'label'       => 'Choose your role',
            'description' => 'dropdown using a model',
            'required'    => TRUE,
            'value'       => '6',
            '_model'      => 'Role',
            '_key'        => 'id',
            '_value'      => 'title',
            'validation'  => 'required|alpha_dash|min:2'
        ),
        'droptest'   => array(
            'type'        => 'dropdown',
            'name'        => 'droptest',
            'label'       => 'Select an option',
            'description' => 'dropdown using options',
            'required'    => TRUE,
            'value'       => '',
            'options'     => array(
                'option1' => 'option 1',
                'option2' => 'option 2',
                'option3' => 'option 3',
                'option4' => 'option 4',
            ),
            'validation' => 'required|alpha_dash|min:2'
        ),
        'radiotest'  => array(
            'type'        => 'radio',
            'name'        => 'radiotest',
            'label'       => 'Pick a radio',
            'description' => 'select a radio option',
            'required'    => FALSE,
            'value'       => '',
            'options'     => array(
                'option 1' => 'option1',
                'option 2' => 'option2',
            ),
            'validation' => 'required|alpha_dash|min:2'
        ),
        'checktest'  => array(
            'type'        => 'checkbox',
            'name'        => 'checktest[]',
            'label'       => 'Select a checkbox',
            'description' => 'select a checkbox option',
            'required'    => FALSE,
            'value'       => '',
            'options'     => array(
                'option 1' => 'option1',
                'option 2' => 'option2',
                'option 3' => 'option3',
                'option 4' => 'option4',
            ),
            'validation' => 'required|alpha_dash|min:2'
        )
    );

    /** Pre-install */
    public function install()
    {
        if ( !Schema::hasTable( 'shoutbox' ) )
        {
            Schema::create( 'shoutbox', function ( Blueprint $table )
            {
                $table->increments( 'id' );
                $table->engine = 'InnoDB';
            } );
        }
    }

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
            return FALSE;
        }

        // Assign module overrides
        foreach ( unserialize( $Module->settings ) as $key => $value )
        {
            $this->settings[$key]['value'] = $value;
        }

        if (Anubis::hasPermission( $this->settings['visibility']['value'] ))
        {
            $this->data['title'] = $module_name;
            $this->data['module_id'] = $Module->id;

            parent::attachModule( MODULE . 'shoutbox', $this->data );
        }

        return FALSE;
    }
}
