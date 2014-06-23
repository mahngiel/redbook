<?php


defined('STDIN') or define( 'STDIN', fopen( 'php://stdin', 'r' ) );
defined('STDOUT') or define( 'STDOUT', fopen( 'php://stdout', 'w' ) );
defined('STDERR') or define( 'STDERR', fopen( 'php://stderr', 'w' ) );

/**
 * Append number ordinality
 *
 * @param $num
 *
 * @return string
 */
function ordinal( $num )
{
    $ends = array( 'th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th' );

    return ( ( $num % 100 ) >= 11 && ( $num % 100 ) <= 13 ) ? $num . 'th' : $num . $ends[$num % 10];
}

/**
 * Determine array dimensions
 *
 * @param array $array
 *
 * @return bool
 */
function is_associative( $array = array() )
{
    // Check if the array is an array, make sure it's not empty, and count array keys to make sure its associative
    return ( is_array( $array ) && ( count( $array ) == 0 || 0 !== count( array_diff_key( $array, array_keys( array_keys( $array ) ) ) ) ) );
}

/**
 * Write to a log
 */
function writelog( $arg, $logfile = 'error_log.txt' )
{
    $log = fopen( $logfile, 'a+b' );

    fwrite( $log, $arg . "\n" );

    fclose( $log );
}

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

        // add the final piece back on
        $root[] = $value;
    }

    return $container;
}

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
