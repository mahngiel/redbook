<?php namespace Reeck\Redbook\Repository\Providers;


interface ModuleRepositoryInterface extends CommonRepositoryInterface {

    /**
     * @return mixed
     */
    public function allModules();

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getModuleById( $id );

    /**
     * @param $slug
     *
     * @return mixed
     */
    public function getModuleByName( $slug );

    /**
     * @param $name
     *
     * @return mixed
     */
    public function moduleExists( $name );

    /**
     * @return mixed
     */
    public function allModuleAreas();

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getModuleAreaById( $id );

    public function newModuleArea();

    public function createArea( $data = array() );

    public function installModule( $data = array() );
}
