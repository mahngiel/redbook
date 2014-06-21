<?php namespace Reeck\Redbook\Repository\Providers;

interface CommonRepositoryInterface {

    /**
     * Return all objects from the repository
     *
     * @return mixed
     */
    public function findAll();

    /**
     * Return an object from the repository by its Id
     *
     * @param $id
     *
     * @return mixed
     */
    public function findByKey( $id );

    /**
     * Return an object from the repository by its slug
     *
     * @param $slug
     *
     * @return mixed
     */
    public function findBySlug( $slug );

    /**
     * Return objects from the database ordered
     *
     * @param       $column
     * @param       $order
     *
     * @return mixed
     */
    public function retrieveOrdered( $column, $order );

    /**
     * Store an object into the repository repository
     *
     * Return repository
     *
     * @param array $data
     *
     * @return mixed
     */
    public function store( $data = array() );

    /**
     * Update a repository object
     *
     * @param       $id
     * @param array $data
     *
     * @return mixed
     */
    public function update( $id, $data = array() );

    /**
     * Destroy a factory object
     *
     * @param $id
     *
     * @return mixed
     */
    public function destroy( $id );

    /**
     * Validate a new object
     *
     * @param $data
     *
     * @return \Illuminate\Validation\Validator
     */
    public function validateNewObject( $data );

    /**
     * Validate an object to be updated
     *
     * @param $data
     *
     * @return \Illuminate\Validation\Validator
     */
    public function validateObjectUpdate( $data );

}
