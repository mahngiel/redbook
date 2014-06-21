<?php namespace Reeck\Redbook\Repository\Factories;

abstract class CommonRedisFactory {

    /**
     * @var \Reeck\Redbook\Support\Redis
     */
    protected $Model;

    /**
     * @param $Model
     * @param $Object
     */
    public function __construct( $Object = null, $Model = null )
    {
        $this->Object = is_null( $Object ) ? null : $Object;
        $this->Model  = is_null( $Model ) ? null : $Model;
    }

    /**
     *
     */
    public function multi()
    {
        $this->Model->multi();
    }

    /**
     *
     */
    public function exec()
    {
        $this->Model->exec();
    }

    /**
     * Check if the object has data
     *
     * @return bool
     */
    public function exists()
    {
        return !is_null( $this->Object );
    }

    public function getKey()
    {
        return isset($this->Object['id'] ) ? $this->Object['id'] : null;
    }

    /**
     * Magic property retrieval
     *
     * Search for a factory method, else return child object
     *
     * @param $var
     *
     * @return null
     */
    public function __get( $var )
    {
        if (isset( $this->Object[$var] ))
        {
            return $this->Object[$var];
        }
        else if (method_exists( $this, $var ))
        {
            return $this->{$var}();
        }
        else if (isset( $this->Model->{$var} ))
        {
            return $this->Model->{$var};
        }

        return null;
    }

    /**
     * Magically set a value to the child object
     *
     * @param $key
     * @param $value
     *
     * @return mixed
     */
    public function __set( $key, $value )
    {
        return $this->Model->{$key} = $value;
    }

    /**
     * Search in the child object for a method
     *
     * Eloquent relationships are handled with magic methods, case provided
     *
     * @param $method
     * @param $parameters
     *
     * @return null
     */
    public function __call( $method, $parameters )
    {
        if (method_exists( $this, $method ) && empty( $parameters ))
        {
            return $this->{$method}();
        }
        else if (method_exists( $this, $method ) && !empty( $parameters ))
        {
            return $this->{$method}( $parameters );
        }
        else if (method_exists( $this->Model, $method ) && !empty( $parameters ))
        {
            return $this->Model->{$method}( $parameters );
        }
        else
        {
            return $this->Model->{$method}();
        }
        //return isset( $this->Object->{$method} ) ? $this->Object->{$method} : $this->Object->{$method}($parameters);
    }
}
