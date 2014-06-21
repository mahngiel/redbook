<?php

/**
 * @param $data
 *
 * @return string
 */
function generateHtmlSnippet($data) {

    $htmlOut = '<h5>'. $data['name'] . '</h5>';

    $htmlOut .= \HTML::$data['type']($data['value']);

    return $htmlOut;

}

/**
 * Sets
 */
\HTML::macro('set', function($setItems) {

    $string = '';

    if( empty($setItems) )
    {
        return $string;
    }

    foreach( $setItems as  $item )
    {
        $string .= '<div class="setChid">'.$item.'</div>';
    }

    return $string;

});

/**
 * Sorted set
 */
\HTML::macro('zset', function($setItems) {

    $string = '';

    if( empty($setItems) )
    {
        return $string;
    }

    $string .= '<table class="pure-table pure-table-striped"><tbody>';

    foreach ($setItems as $listValue)
    {
        $string .= "<tr><td>{$listValue[1]}</td><td>{$listValue[0]}</td>";
    }

    return $string .= '</tbody></table>';

});

/**
 * Lists
 */
\HTML::macro('list', function($listItems) {

    $string = '';

    if( empty($listItems) )
    {
        return $string;
    }


    $string .= '<table class="pure-table pure-table-striped"><tbody>';

    foreach ($listItems as $listIndex => $listValue)
    {
        $string .= "<tr><td>{$listIndex}</td><td>{$listValue}</td>";
    }

    return $string .= '</tbody></table>';

});

/**
 * Hashes
 */
\HTML::macro('hash', function($hashMap) {

    $string = '';

    if( empty($hashMap) )
    {
        return $string;
    }

    $string .= '<table class="pure-table pure-table-striped"><tbody>';

    foreach( $hashMap as $schemaKey => $schemaValue )
    {
        $string .= "<tr><td>{$schemaKey}</td><td>{$schemaValue}</td>";
    }

    return $string .= '</tbody></table>';
});

/**
 * Strings
 */
\HTML::macro('string', function($value) {

    return '<div>'.$value.'</div>';
});
