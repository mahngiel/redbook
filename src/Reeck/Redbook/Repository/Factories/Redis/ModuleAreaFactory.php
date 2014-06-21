<?php namespace Reeck\Redbook\Repository\Factories\Redis;

use Reeck\Redbook\Repository\Factories\CommonRedisFactory;

/**
 * Class CategoryFactory
 *
 * @package Matador\Repository\Factories\Eloquent
 */
class ModuleAreaFactory extends CommonRedisFactory {

    protected $Object;

    /**
     * @var \Models\Redbook\Redis\Module
     */
    protected $Model;

    /**
     * @return string
     */
    public function getSlug()
    {
        return slugify( $this->Object['slug'] );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->Object['name'];
    }

    public function getStatus()
    {
        return $this->Object['status'];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */


} 
