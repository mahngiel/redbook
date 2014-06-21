<?php namespace Reeck\Redbook\Repository\Providers\Redis;

use Reeck\Redbook\Models\Redis\Module;
use Reeck\Redbook\Models\Redis\ModuleArea;
use Reeck\Redbook\Repository\Factories\Redis\ModuleFactory;
use Reeck\Redbook\Repository\Factories\Redis\ModuleAreaFactory as AreaFactory;
use Reeck\Redbook\Repository\Providers\ModuleRepositoryInterface;
use Symfony\Component\Process\Exception\InvalidArgumentException;

/**
 * Class ModuleProvider
 *
 * @package Matador\Repository\Providers\Eloquent
 */
class ModuleProvider implements ModuleRepositoryInterface {

    /**
     * Return all objects from the repository
     *
     * @return mixed
     */
    public function findAll()
    {
        // TODO: Implement getAll() method.
    }

    /**
     * Return an object from the repository by its Id
     *
     * @param $id
     *
     * @return mixed
     */
    public function findByKey( $id )
    {
        // TODO: Implement getByKey() method.
    }

    /**
     * Return an object from the repository by its slug
     *
     * @param $slug
     *
     * @return mixed
     */
    public function findBySlug( $slug )
    {
        // TODO: Implement findBySlug() method.
    }

    /**
     * Return objects from the database ordered
     *
     * @param       $column
     * @param       $order
     *
     * @return mixed
     */
    public function retrieveOrdered( $column, $order )
    {
        // TODO: Implement getOrdered() method.
    }

    /**
     * Store an object into the repository repository
     *
     * Return repository
     *
     * @param array $data
     *
     * @return mixed
     */
    public function store( $data = array() )
    {
        // TODO: Implement store() method.
    }

    /**
     * Update a repository object
     *
     * @param       $id
     * @param array $data
     *
     * @return mixed
     */
    public function update( $id, $data = array() )
    {
        // TODO: Implement update() method.
    }

    /**
     * Validate a new object
     *
     * @param $data
     *
     * @return mixed
     */
    public function validateNewObject( $data )
    {
        // TODO: Implement validateNewObject() method.
    }

    /**
     * Validate an object to be updated
     *
     * @param $data
     *
     * @return mixed
     */
    public function validateObjectUpdate( $data )
    {
        // TODO: Implement validateObjectUpdate() method.
    }

    /**
     * Update the current scoped object
     *
     * @param array $data
     *
     * @return mixed
     */
    public function updateObject( $Object, $data = array() )
    {
        // TODO: Implement updateObject() method.
    }

    /**
     * Destroy a factory object
     *
     * @param $id
     *
     * @return mixed
     */
    public function destroy( $id )
    {
        $Object = Module::findOrFail( $id );

        $Object->delete();

        return true;
    }

    /**
     * Return the cached object
     *
     * @return mixed
     */
    public function object()
    {
        // TODO: Implement object() method.
    }

    /**
     * @return \Reeck\Redbook\\ModelsRedis\ModuleAreas[]
     */
    public function allModules()
    {
        $Modules = new Module();

        $Objects = array();

        foreach( $Modules->getStackMembers('all', null) as $Object )
        {
            $Objects[] = new ModuleFactory( $Modules->getHashMembers('object', $Object) );
        }

        return $Objects;
    }

    /**
     * @param $id
     *
     * @return static
     */
    public function getModuleById( $id )
    {
        return Module::find( $id );
    }

    /**
     * @param $slug
     *
     * @return mixed
     */
    public function getModuleByName( $slug )
    {
        $Module = new Module();

        return new ModuleFactory( $Module->getHashMembers( 'object', $slug ) );
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function moduleExists( $name )
    {
        $Module = new Module();

        return $Module->isMemberInStack( 'all', null, $name );
    }

    /**
     * @return \Eloquent[]|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function allModuleAreas()
    {
        $ModuleAreas = new ModuleArea();

        $Objects = array();

        foreach( $ModuleAreas->getStackMembers('all', null) as $Object )
        {
            $Objects[] = new AreaFactory( $ModuleAreas->getHashMembers('object', $Object) );
        }

        return $Objects;
    }

    /**
     * @param $id
     *
     * @return static
     */
    public function getModuleAreaById( $id )
    {
        return ModuleArea::find( $id );
    }

    /**
     * @return ModuleArea
     */
    public function newModuleArea()
    {
        return new ModuleArea;
    }

    /**
     * @param array $data
     *
     * @return static
     * @throws \Symfony\Component\Process\Exception\InvalidArgumentException
     */
    public function createArea( $data = array() )
    {
        if (empty( $data ))
        {
            throw new InvalidArgumentException( 'Cannot store empty data' );
        }

        return ModuleArea::create( $data );
    }

    /**
     * @param array $data
     *
     * @return static
     * @throws \Symfony\Component\Process\Exception\InvalidArgumentException
     */
    public function installModule( $data = array() )
    {
        if (empty( $data ))
        {
            throw new InvalidArgumentException( 'Cannot store empty data' );
        }

        return Module::create( $data );
    }

    /**
     * @param int   $id
     * @param array $data
     *
     * @return static
     * @throws \Symfony\Component\Process\Exception\InvalidArgumentException
     */
    public function updateModule( $id, $data = array() )
    {
        if (empty( $data ))
        {
            throw new InvalidArgumentException( 'Cannot store empty data' );
        }

        $Object = $this->getModuleById( $id );

        $Object->update( $data );

        return $Object;
    }
}
