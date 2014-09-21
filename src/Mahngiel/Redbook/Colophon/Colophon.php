<?php namespace Mahngiel\Redbook\Colophon;

use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * Class Colophon
 *
 * @package Redbook\Colophon
 */
class Colophon {

    /**
     * CMS Version
     */
    const app_version = '0.1';

    /**
     * Application Name
     */
    const app_name = "Redbook: A Redis Schema Visualizer";

    /**
     * Environment's config file
     *
     * @var string
     */
    protected $configFile;

    /**
     * App's theme
     *
     * @var
     */
    protected $environment;

    /**
     * @var
     */
    protected $package;

    /**
     * Application stylesheets
     *
     * @var array
     */
    public $stylesheets = array();

    /**
     * Scripts for the base of the page
     *
     * @var array
     */
    public $footerScripts = array();

    /**
     * Scripts for the head of the page
     *
     * @var array
     */
    public $headScripts = array();

    /**
     * Initializations
     */
    public function __construct()
    {
        defined( 'PACKAGE' ) or define( 'PACKAGE', 'redbook::' );
        defined( 'PACKAGE_PATH' ) or define( 'PACKAGE_PATH', '/packages/mahngiel/redbook/' );
        defined( 'ASSET_URL' ) or define( 'ASSET_URL', \Request::getSchemeAndHttpHost() . PACKAGE_PATH );

        // View paths
        defined( 'MODULE' ) or define( 'MODULE', PACKAGE . 'modules.' );

        // Cache the environment's config file
        $this->configFile = app_path( 'config' ) . PACKAGE_PATH . '/redbook.php';

        // Init default scripts and styles
        $this->defaultFooterScripts();
        $this->defaultHeadScripts();
        $this->defaultStylesheets();
    }

    /**
     * @param $package
     */
    public function setPackage( $package )
    {
        $this->package = $package;
    }

    /**
     * @return mixed
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * @param $environment
     */
    public function setEnvironment( $environment )
    {
        $this->environment = $environment;
    }

    /**
     * @return mixed
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * Retrieve the application name
     *
     * @return string
     */
    public function getAppName()
    {
        return self::app_name;
    }

    /**
     * Retrieve the application version
     *
     * @return string
     */
    public function getAppVersion()
    {
        return 'version ' . self::app_version;
    }

    /**
     * Define the default page head scripts
     */
    private function defaultHeadScripts()
    {
        $this->headScripts = array(
            'modernizr'  => 'js/libs/modernizr.js',
            //                        'jQuery'     => '//code.jquery.com/jquery-2.1.1.min.js',
            'jQuery'     => 'js/libs/jquery.js',
            //            'fastClick'  => '//cdnjs.cloudflare.com/ajax/libs/fastclick/0.6.7/fastclick.min.js',
            'fastClick'  => 'js/libs/fastclick.js',
            //            'angular'    => '//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js',
            'foundation' => 'js/libs/foundation.min.js',
            //            'ng_dbCtrl'  => 'js/controllers/dbController.js',
            //            'ng_dbSvc'   => 'js/services/databaseService.js',
        );
    }

    /**
     * Define the default page footer scripts
     */
    private function defaultFooterScripts()
    {
        $this->footerScripts = array(
            //            'jQuery_cookie' => 'js/libs/jquery.cookie.js',
            //            'Bootstrap'      => 'js/libs/bootstrap.min.js',
            //            'redbook'       => 'js/redbook.js',
            //            'App_global'    => 'js/global.js',
            //            'App_navigation' => 'js/navigation.js',
            //            'App_stuff'     => 'js/main.js',
        );
    }

    /**
     * Return the page's stylesheets
     */
    private function defaultStylesheets()
    {
        $this->stylesheets = array(
            'Foundation' => [ 'href' => 'css/foundation.min.css' ],
            'Normalize'  => [ 'href' => 'css/normalize.css' ],
            'App_custom' => [ 'href' => 'css/styles.css' ],
            //            'Foundation_CSS' => array('href'=>'css/foundation.css'),
            //            'Foundation' => [ 'href' => '//cdn.jsdelivr.net/foundation/5.4.3/css/foundation.css' ],
            //            'UI_BootstrapTheme' => array( 'href' => 'css/bootstrap-theme.min.css' ),
            //            'UI_Bootstrap'      => array( 'href' => 'css/bootstrap.min.css' ),
            //            'UI_Pure'           => array( 'href' => '//yui.yahooapis.com/pure/0.5.0/pure-min.css' ),
            //            'App_Pure'          => array( 'href' => 'css/pure.css' ),
        );
    }

    /**
     * Add a script to the base of the page
     *
     * @param $name
     * @param $scriptPath
     */
    public function addScriptToFooter( $name, $scriptPath )
    {
        $this->footerScripts[$name] = $scriptPath;
    }

    /**
     * Add a script to the head of the page
     *
     * @param $name
     * @param $scriptPath
     */
    public function addScriptToHead( $name, $scriptPath )
    {
        $this->headScripts[$name] = $scriptPath;
    }

    /**
     * Add a stylesheet to the page
     *
     * @param       $name
     * @param       $stylePath
     * @param array $attributes
     */
    public function addStylesheet( $name, $stylePath, $attributes = array() )
    {
        $this->stylesheets[$name] = array( 'href' => $stylePath, 'attr' => $attributes );
    }

    /**
     * Stylesheet loading logic
     */
    public function getStylesheets()
    {
        $out = '';

        foreach ($this->stylesheets as $style)
        {
            // check if asset is local and append the file time to it, ensuring latest version is always served
            $path = public_path( PACKAGE_PATH . $style['href'] );

            if (\File::exists( $path ))
            {
                $style['href'] = ASSET_URL . $style['href'] . '?' . filemtime( $path );
            }

            $out .= \HTML::style( $style['href'], ( isset( $style['attr'] ) ? $style['attr'] : array() ) );
        }

        return $out;
    }

    /**
     * Return the page's footer scripts
     *
     * @return string
     */
    public function getFooterScripts()
    {
        $out = '';

        foreach ($this->footerScripts as $script)
        {
            // check if asset is local and append the file time to it, ensuring latest version is always served
            $path = public_path( PACKAGE_PATH . $script );

            if (\File::exists( $path ))
            {
                $script = ASSET_URL . $script . '?' . filemtime( $path );
            }
            $out .= \HTML::script( $script );
        }

        return $out;
    }

    /**
     * Return the page's head scripts
     *
     * @return string
     */
    public function getHeadScripts()
    {
        $out = '';

        foreach ($this->headScripts as $script)
        {
            // check if asset is local and append the filetime to it, ensuring latest version is always served
            $path = public_path( PACKAGE_PATH . $script );

            if (\File::exists( $path ))
            {
                $script = ASSET_URL . $script . '?' . filemtime( $path );
            }

            $out .= \HTML::script( $script );
        }

        return $out;
    }

    /**
     * Updates individual keys in the config
     *
     * @param $key
     * @param $value
     *
     * @return bool
     */
    public function update_config( $key, $value )
    {
        // Try to overwrite the config file
        try
        {
            $App_Config = \File::get( $this->configFile );

            $new_file = str_replace( 'key', 'value', $App_Config );

            \File::put( $this->configFile, $new_file );

            return true;
        } // Unable to write to the config file
        catch ( \Exception $e )
        {

            \Session::flash( 'error', $e->getMessage() );

            return false;
        }
    }

    /**
     * Writes the config file
     *
     * @throws FileNotFoundException
     * @throws FileException
     */
    public function generateConfig( $configName, $configData )
    {
        $configPath = app_path( "config/packages/redbook/{$configName}" );

        if (!\File::exists( $configPath ))
        {
            throw new FileNotFoundException( null, 500, null, $configPath );
        }

        if (!\File::isWritable( $configPath ))
        {
            throw new FileException( sprintf( "%s is not writable - please check permissions", $configPath ) );
        }

        // recreate laravel config template
        $config   = array();
        $config[] = "<?php \n\n return array( \n";

        // iterate through passed data
        foreach ($configData as $key => $value)
        {
            // force booleans
            if ($value === '0' || $value === '1')
            {
                // writing out the words "true" or "false" isn't going to get us anywhere, use 0 & 1
                $config[] = "\t'{$key}' => " . $value === '1' ? 1 : 0 . ", ";
            }
            // strings
            else
            {
                $config[] = "\t'{$key}' => '{$value}', ";
            }
        }

        $config[] = "); ";

        \File::put( $configPath, implode( "\n", $config ) );
    }
}
