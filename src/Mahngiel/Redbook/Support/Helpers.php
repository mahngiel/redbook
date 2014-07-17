<?php


defined( 'STDIN' ) or define( 'STDIN', fopen( 'php://stdin', 'r' ) );
defined( 'STDOUT' ) or define( 'STDOUT', fopen( 'php://stdout', 'w' ) );
defined( 'STDERR' ) or define( 'STDERR', fopen( 'php://stderr', 'w' ) );
defined( 'DS' ) or define( 'DS', DIRECTORY_SEPARATOR );

if (!function_exists( 'truncate' ))
{
    /**
     * @param $string
     *
     * @return string
     */
    function truncate( $string )
    {
        if (strlen( $string ) > 40)
        {
            $string = str_replace( "\n", '', preg_replace( '/\s+?(\S+)?$/', '', substr( $string, 0, 40 ) ) ) . '...';
        }

        return $string;
    }
}

if (!function_exists( 'redisHashIntersect' ))
{
    /**
     * Recreates an array with even keyed values as the key
     * Useful for redis hashes and sorted sets
     *
     * In: [ 'foo', 'bar', 'dim', 'sum' ]
     *
     * Out: $a['foo'] = 'bar', $a['dim'] = 'sum'
     *
     * @param $hashArray
     *
     * @return array
     */
    function redisHashIntersect( $hashArray )
    {
        // return empty
        if (empty( $hashArray ))
        {
            return array();
        }

        // iterate through array
        $outArray = array();
        $lastVar  = null;
        foreach ($hashArray as $key => $value)
        {
            // set even keys as new indices
            if ($key % 2 == 0)
            {
                $outArray[$value] = '';
                // stash val for future reference
                $lastVar = $value;
            }
            else
            {
                // odd keys are values
                $outArray[$lastVar] = $value;
            }
        }

        return $outArray;
    }
}

if (!function_exists( 'debug' ))
{
    /**
     * Quick and easy var dumping
     *
     * @param $objects
     */
    function debug( $objects )
    {
        echo '<pre>';
        print_r( $objects );
        die;
    }
}

if (!function_exists( 'createSelectFromArray' ))
{
    /**
     * Walks through arrays and objects to create a
     * single array mapped to a definition
     *
     * @param       $Objects
     * @param       $asKey
     * @param       $asValue
     *
     * @return array
     */
    function createSelectFromArray( $Objects, $asKey, $asValue )
    {
        $selectOptions = array();

        if (empty( $Objects ))
        {
            return $selectOptions;
        }

        foreach ($Objects as $Object)
        {
            if (is_array( $Object ))
            {
                $selectOptions[$Object[$asKey]] = $Object[$asValue];
            }
            else
            {
                $selectOptions[$Object->{$asKey}] = $Object->{$asValue};
            }
        }

        return $selectOptions;
    }
}

if (!function_exists( 'deslug' ))
{
    /**
     * Transform a slugged string into words
     *
     * @param $term
     * @param $joinedBy
     *
     * @return string
     */
    function deslug( $term, $joinedBy )
    {
        return implode( ' ', explode( $joinedBy, $term ) );
    }
}

if (!function_exists( 'slugify' ))
{
    /**
     * Replace characters in a string useful for URIs
     *
     * Str_replace shorthand for commonality
     *
     * @param        $term
     * @param string $with
     *
     * @return mixed
     */
    function slugify( $term, $replace = ' ', $with = '-' )
    {
        return str_replace( $replace, $with, $term );
    }
}

if (!function_exists( 'mapRedisSchema' ))
{
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
    function mapRedisSchema( array $namespaces, $separator = ":" )
    {
        // create container for keys
        $container = array();

        // iterate through each key
        foreach ($namespaces as $namespace)
        {
            // break up by the namespace
            $path = explode( $separator, $namespace );

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

            if (is_string( $root ))
            {
                continue;
            }

            // add the final piece back on
            $root[] = $value;
        }

        return $container;
    }
}

if (!function_exists( 'makeRedisSchemaTree' ))
{

    function makeRedisSchemaTree( array $tree, $newRound = true, $oldWord = null )
    {
        $out = '';

        if ($oldWord)
        {
            $oldWord .= \Config::get( 'redbook::redbook.schemaSeparator' );
        }

        foreach ($tree as $k => $ele)
        {
            if (is_array( $ele ))
            {
                $out .= '<li><a href="#" class="schema-collapse"><i class="fa fa-folder-o"></i> ' . $k . '</a>';
                $out .= '<ul class="schema-container">' . makeRedisSchemaTree( $tree[$k], false, $oldWord . $k ) . '</ul>';
                $out .= '</li>';
            }
            else
            {
                $out .= '<li class="schema-key"><a class="ajaxSchemaKey" data-schema="key" data-key="' . $oldWord . $ele . '" href="' . REDBOOK_URI . 'key/' . $oldWord . $ele . '"><i class="fa fa-key"></i> ' . $oldWord . $ele . '</a>';
            }
        }

        return $out . '</li>';
    }
}

if (!function_exists( 'searchRecursive' ))
{
    /**
     * Recursively retrieve array key
     *
     * @param $array
     * @param $term
     *
     * @return bool|array
     */
    function searchRecursive( $array, $term )
    {
        if (!is_array( $array ))
        {
            return false;
        }

        if (isset( $array[$term] ))
        {
            return $array[$term];
        }

        foreach ($array as $key => $subArray)
        {
            // immediate match?
            if ($key === $term)
            {
                return $subArray;
            }

            // iterate children
            if (is_array( $subArray ))
            {
                $results = searchRecursive( $subArray, $term );

                if ($results != false)
                {
                    return $results;
                }
            }
        }

        return false;
    }
}
