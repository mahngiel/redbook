<?php
/**
 * An helper file for Laravel 4, to provide autocomplete information to your IDE
 * Generated with https://github.com/barryvdh/laravel-ide-helper
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */
namespace {
    die( 'Only to be used as an helper for your IDE' );
}

namespace {
    /**
     * Class Colophon
     */
    class Colophon extends \Redbook\Support\Facades\Colophon {
        /**
         * @var \Mahngiel\Redbook\Colophon\Colophon
         */
        static private $root;

        /**
         * @return string
         */
        public static function getAppName()
        {
            return static::$root->getAppName();
        }

        /**
         * @return string
         */
        public static function getAppVersion()
        {
            return static::$root->getAppVersion();
        }

        /**
         * @param $name
         * @param $scriptPath
         */
        public static function addScriptToFooter( $name, $scriptPath )
        {
            static::$root->addScriptToFooter($name, $scriptPath);
        }

        /**
         * @param $name
         * @param $scriptPath
         */
        public static function addScriptToHead( $name, $scriptPath )
        {
            static::$root->addScriptToHead($name, $scriptPath);
        }

        /**
         * @param       $name
         * @param       $stylePath
         * @param array $attributes
         */
        public static function addStylesheet( $name, $stylePath, array $attributes )
        {
            static::$root->addStylesheet($name, $stylePath, $attributes);
        }

        /**
         * @return string
         */
        public static function getFooterScripts()
        {
            return static::$root->getFooterScripts();
        }

        /**
         * @return string
         */
        public static function getHeadScripts()
        {
            return static::$root->getHeadScripts();
        }

        /**
         * @return string
         */
        public static function getStylesheets()
        {
            return static::$root->getStylesheets();
        }
    }
}
