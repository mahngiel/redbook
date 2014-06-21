<?php namespace Reeck\Redbook\Repository\Factories\Redis;

use Reeck\Redbook\Repository\Factories\CommonRedisFactory;

/**
 * Class ModuleFactory
 *
 * @package Redbook\Repository\Factories\Redis
 */
class ModuleFactory extends CommonRedisFactory {

    /**
     * @var
     */
    protected $Object;

    /**
     * @var \Models\Redbook\Redis\ModuleArea
     */
    protected $Model;

    /**
     * @return string
     */
    public function getSlug()
    {
        return slugify($this->Object['slug']);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->Object['name'];
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->Object['status'];
    }

    /**
     * @return mixed
     */
    public function getAreaKey()
    {
        return $this->Object['areaId'];
    }

    /**
     * @return mixed
     */
    public function getAreaName()
    {
        return $this->Object['areaName'];
    }

    /**
     * @return mixed
     */
    public function getFactory()
    {
        return $this->Object['factory'];
    }

    /**
     * @return mixed
     */
    public function getSettings()
    {
        return $this->Object['settings'];
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->Object['priority'];
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->Object['createdAt'];
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->Object['updatedAt'];
    }


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */


} 
