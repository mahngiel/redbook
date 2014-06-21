<?php namespace Reeck\Redbook\Exceptions;

class RedisKeyException extends \Exception {

    public function __construct( $message, $code = 500 )
    {
        parent::__construct( $message, $code );
    }
}
