<?php namespace Reeck\Redbook\Colophon;

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
    const app_name = 'Redbook Redis Viewer';

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
        defined( 'ASSET_URL' ) or define( 'ASSET_URL', \Request::getSchemeAndHttpHost() . '/packages/reeck/redbook/' );

        // View paths
        defined( 'FRONTEND' ) or define( 'FRONTEND', PACKAGE . 'frontend.' );
        defined( 'BACKEND' ) or define( 'BACKEND', PACKAGE . 'backend.' );
        defined( 'PARTIAL' ) or define( 'PARTIAL', PACKAGE . 'partials.' );
        defined( 'MODULE' ) or define( 'MODULE', PACKAGE . 'modules.' );

        // Cache the environment's config file
        $this->configFile = app_path( 'config' ) . '/' . \App::environment() . '/redbook.php';

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
            'modernizr' => 'js/libs/modernizr.min.js',
        );
    }

    /**
     * Define the default page footer scripts
     */
    private function defaultFooterScripts()
    {
        $this->footerScripts = array(
            'jQuery'         => '//code.jquery.com/jquery-2.1.0.min.js',
            'jQuery_cookie'  => 'js/libs/jquery.cookie.js',
            'Yui'            => '//yui.yahooapis.com/3.14.1/build/yui/yui.js',
            'App_global'     => 'js/global.js',
            'App_navigation' => 'js/navigation.js',
        );
    }

    /**
     * Return the page's stylesheets
     */
    private function defaultStylesheets()
    {
        $this->stylesheets = array(
            'App_Pure'   => array( 'href' => 'css/pure.css' ),
            'pure_email' => array( 'href' => 'css/email.css' ),
            'App_custom' => array( 'href' => 'css/styles.css' ),
            'UI_Pure'    => array( 'href' => 'http://yui.yahooapis.com/pure/0.4.2/pure-min.css' ),
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
            $path = public_path( 'packages/reeck/redbook/' . $style['href'] );

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
            $path = public_path( 'packages/reeck/redbook/' . $script );

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
            $path = public_path( 'packages/reeck/redbook/' . $script );

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
     */
    public function generate_config()
    {
        if (!\File::isWritable( $this->configFile ))
        {
            if (!chmod( $this->configFile, 0775 ))
            {
                throw new FileException( 'The configuration file is not writable!' );
            }
        }

        $Provider = new SettingProvider();

        $config   = array();
        $config[] = "<?php \n\n return array( \n";
        $config[] = "\t'version' => '" . self::cms_version . "', ";
        $config[] = "\t'app_name' => '" . self::app_name . "', ";

        foreach ($Provider->whereSetting( 'in_config', '=', true, array( 'slug', 'value' ) ) as $Setting)
        {
            // Force boolean
            if ($Setting->value == '0' || $Setting->value == '1')
            {
                $config[] = "\t'{$Setting->slug}' => " . ( $Setting->value === '1' ? 1 : 0 ) . ", ";
            }
            else
            {
                $config[] = "\t'{$Setting->slug}' => '{$Setting->value}', ";
            }
        }

        $config[] = "); ";

        \File::put( $this->configFile, implode( "\n", $config ) );
    }
}
