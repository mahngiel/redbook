<?php namespace Reeck\Redbook\Exceptions;

class RedisSchemaException extends \Exception {

    public function __construct( $message='Requested Schema does not exist', $code = 500 )
    {
        parent::__construct( $message, $code );
    }
}
