<?php namespace Reeck\Redbook\Modules;

use Reeck\Redbook\Repository\Providers\Redis\ModuleProvider;
use Symfony\Component\Debug\Exception\FatalErrorException;

/**
 * Class Modules
 *
 * @package Grizzly\Modules
 */
class Modules {

    /**
     * @var array
     */
    protected $installed = array();

    /**
     * @var array
     */
    protected $areas = array();

    /**
     * @var array
     */
    public $data = array(
        'title'     => '',
        'module_id' => '',
        'Objects'   => array(),
    );

    /**
     * @var \Reeck\Redbook\Repository\Providers\Redis\ModuleProvider
     */
    protected $_Provider;

    /**
     *
     */
    public function __construct()
    {
        $this->_Provider = new ModuleProvider();

        $this->initialize();
    }

    /**
     * Retrieve all modules and areas
     */
    private function initialize()
    {
        foreach ($this->_Provider->allModules() as $Module)
        {
            /* @var \Reeck\Redbook\Repository\Factories\Redis\ModuleFactory $Module */
            $this->installed[$Module->getSlug()] = array(
                'id'       => $Module->getKey(),
                'name'     => $Module->getName(),
                'slug'     => $Module->getSlug(),
                'factory'  => $Module->getFactory(),
                'area'     => $Module->getAreaKey(),
                'priority' => $Module->getPriority()
            );
        }

        foreach ($this->_Provider->allModuleAreas() as $Area)
        {
            /* @var \Reeck\Redbook\Repository\Factories\Redis\ModuleAreaFactory $Area */
            $this->areas[$Area->getSlug()] = array(
                'id' => $Area->getKey(), 'name' => $Area->getName(), 'status' => $Area->getStatus()
            );
        }
    }

    /**
     * @return array
     */
    public function getInstalled()
    {
        return $this->installed;
    }

    /**
     * @return array
     */
    public function getAreas()
    {
        return $this->areas;
    }

    /**
     * @param $module_name
     *
     * @return bool
     */
    public function isInstalled( $module_name )
    {
        return isset( $this->installed[$module_name] );
    }

    /**
     * @param $area_slug
     *
     * @return bool
     */
    private function areaExists( $area_slug )
    {
        return isset( $this->areas[$area_slug] ) ? $this->areas[$area_slug]['id'] : false;
    }

    /**
     * @return array
     */
    public function getAvailableModules()
    {
        return $this->scanModules();
    }

    /**
     * @return array
     */
    private function scanModules()
    {
        // Assign available modules
        $available_modules = array();

        // Loop through the module files
        foreach (glob( app_path() . '/modules/*_Module.php' ) as $module)
        {
            // Get the file name
            $module_factory = basename( $module, '.php' );

            // Get the file name
            array_push( $available_modules, $this->readModule( $module_factory ) );
        }

        // Return the available modules
        return $available_modules;
    }

    /**
     * @param string $module_factory
     *
     * @return bool|object
     */
    public function readModule( $module_factory = '' )
    {
        $module_path = app_path() . '/modules/' . $module_factory . '.php';

        // Check if the module exists
        if (file_exists( $module_path ))
        {
            // Include the module
            include_once( $module_path );

            // Assign class name
            $class_name = 'Matador\\Module\\' . ucfirst( $module_factory );

            // Initiate the module
            $module = new $class_name;

            // Retrieve the module information
            //$module = (object)get_object_vars( $module );

            // Assign factory
            $module->factory = $module_factory;

            // Return the module
            return $module;
        }
        else
        {
            // File doesn't exist, return FALSE
            return false;
        }
    }

    /**
     * @param string $slug
     *
     * @return bool
     */
    public function getModuleArea( $slug = '' )
    {
        // lowercase the slug
        $slug = strtolower( $slug );

        // Validate area existence
        if (!$area_id = $this->areaExists( $slug ))
        {
            return false;
        }

        $modules = array();

        // Retrieve its modules
        foreach ($this->installed as $installed)
        {
            if ($installed['area'] == $area_id)
            {
                $modules[$installed['slug']] = $installed;
            }
        }

        // Arrange modules by priority
        if (!empty( $modules ))
        {
            $priority = array();

            foreach ($modules as $key => $module)
            {
                $priority[$key] = $module['priority'];
            }

            array_multisort( $modules, SORT_DESC, $priority );

            foreach (array_keys( $modules ) as $module)
            {
                $this->getModule( $module );
            }
        }
    }

    /**
     * @return \Eloquent[]|\Illuminate\Database\Eloquent\Collection|static
     */
    public function getModuleAreas()
    {
        $Areas = $this->_Provider->getModuleAreaById( 3 );

        // iterate through areas
        foreach ($this->areas as $area)
        {
            // iterate through installed modules
            foreach ($this->installed as $installed)
            {
                if ($installed['area'] == $area['id'])
                {
                    $area['modules'][$installed['name']] = $installed;
                }
            }

            if (!empty( $area['modules'] ))
            {
                $priority = array();
                foreach ($area['modules'] as $name => $module)
                {
                    $priority[] = $module['priority'];
                }

                array_multisort( $area['modules'], SORT_DESC, $priority );
            }
        }

        // return
        return $this->areas;
    }

    /**
     * @param string $module_name
     *
     * @return bool
     */
    public function getModule( $module_name = '' )
    {
        // Check if data is valid
        if (empty( $this->installed[$module_name] ))
        {
            // Data is invalid, return FALSE;
            return false;
        }

        // Create the module's path
        $module = __DIR__ . '/modules/' . str_replace( ' ', '', $this->installed[$module_name]['factory'] ) . '_Module.php';

        // Check if the module file exists
        if (file_exists( $module ) && $this->_Provider->moduleExists( $module_name ))
        {
            // Include the module
            include_once( $module );

            // Assign class name
            $Class = 'Reeck\\Redbook\\Modules\\Modules\\' . ucfirst( basename( $this->installed[$module_name]['factory'] . '_Module' ) );

            try
            {
                // Initiate the module
                $Module = new $Class;
            }
            catch ( FatalErrorException $e )
            {
                die( $e->getMessage() );
            }

            // Return the module
            return $Module->start( $module_name );
        }

        // module doesn't exist, return FALSE
        return false;
    }

    /**
     * @param $module_name
     *
     * @return mixed
     */
    public function retrieveModule( $module_name )
    {
        return $this->_Provider->getModuleByName( $module_name );
    }

    /**
     * @param $module
     *
     * @return mixed
     */
    public function initModule( $module )
    {
        // Create the module's path
        $path = app_path() . '/modules/' . $module . '.php';

        // Include the module
        include_once( $path );

        // Assign class name
        $Class = 'Matador\\Module\\' . ucfirst( $module );

        // Initiate the module
        return new $Class;
    }

    /**
     * Module Factory Validation
     *
     * Validates settings against defined factory rules
     *
     * @param $settings
     * @param $data
     *
     * @return Validator
     */
    public function validateInstall( $settings, $data )
    {
        $rules = array();

        foreach ($settings as $key => $value)
        {
            if (!empty( $key['validation'] ))
            {
                $rules[$key] = $value['validation'];
            }
        }

        return \Validator::make( $data, $rules );
    }

    /**
     * Render a drawer tray
     *
     * @param       $path
     * @param array $data
     */
    public function open_tray( $path, $data = array() )
    {
        // Graceful fallback to default theme view file
        // by replacing an unfound theme view with default
        if (!\View::exists( $path ))
        {
            $parts    = explode( '.', $path );
            $parts[1] = 'default';
            $path     = implode( '.', $parts );
        }

        echo View::make( MODULE . 'drawer' )->nest( 'tray', $path, $data );
    }

    /**
     * Wraps a module within the standard module container
     *
     * @param string $template
     * @param string $path
     * @param array  $data
     */
    public function attachModule( $template = 'module', $path, $data = array() )
    {
        // Graceful fallback to default theme view file
        // by replacing an unfound theme view with default
        if (!\View::exists( $path ))
        {
            $parts    = explode( '.', $path );
            $parts[1] = 'default';
            $path     = implode( '.', $parts );
        }

        echo \View::make( MODULE . "template/$template" )
                  ->with( 'icon', isset( $data['icon'] ) ? $data['icon'] : 'fa fa-info' )
                  ->with( 'title', $data['title'] )
                  ->with( 'module_id', $data['module_id'] )
                  ->nest( 'module_data', $path, $data['Objects'] );
    }

    /**
     * Generates a modules content without the wrapper
     * Useful for AJAX
     *
     * @param       $path
     * @param array $data
     */
    public function moduleInnerContent( $path, $data = array() )
    {
        echo \View::make( $path )->with( 'Objects', $data );
    }

    /**
     * @param       $path
     * @param array $data
     */
    public function rawContainer( $path, $data = array() )
    {
        echo \View::make( $path )->with( $data );
    }
}
