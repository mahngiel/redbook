<?php namespace Reeck\Redbook\Exceptions;

class EmptyRedisObjectException extends \Exception {
    public function __construct( $message='Redis schema object is empty', $code = 500 )
    {
        parent::__construct( $message, $code );
    }
}
