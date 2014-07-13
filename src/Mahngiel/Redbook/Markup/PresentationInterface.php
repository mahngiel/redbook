<?php namespace Mahngiel\Redbook\Markup;

/**
 * Interface PresentationInterface
 *
 * @package Mahngiel\Redbook\Markup
 */
interface PresentationInterface {

    /**
     * Get tree starting HTML
     *
     * @return string
     */
    public function getTreeWrapperStart();

    /**
     * Get tree closing HTML
     *
     * @return string
     */
    public function getTreeWrapperEnd();

    /**
     * Tree key element start
     *
     * @param string $namespace
     *
     * @return mixed
     */
    public function getItemObjectStart( $namespace );

    /**
     * Tree key anchor start
     *
     * @param $keyName
     *
     * @return string
     */
    public function getItemAnchorStart( $keyName );

    /**
     * Tree key icon
     *
     * @param $keyName
     *
     * @return string
     */
    public function getListItemIcon();

    /**
     * Tree key anchor end
     *
     * @return string
     */
    public function getItemAnchorEnd();

    /**
     * Namespace container list wrapper
     *
     * @param string $namespace
     * @param $key
     *
     * @return string
     */
    public function startChildContainer( $namespace );

    /**
     * Namespace element anchor start
     *
     * @return mixed
     */
    public function getContainerAnchorStart();

    /**
     * Namespace element anchor end
     *
     * @return mixed
     */
    public function getContainerAnchorEnd();

    /**
     * Namespace element icon
     *
     * @return mixed
     */
    public function getChildContainerIcon();

    /**
     * Namespace container list wrapper end
     *
     * @return string
     */
    public function endChildContainer();

    /**
     * Namespace tree item wrapper
     *
     * @param string $namespace
     *
     * @return string
     */
    public function startParentContainer( $namespace );

    /**
     * Namespace tree item wrapper end
     *
     * @return string
     */
    public function endParentContainer();
} 
