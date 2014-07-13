<?php namespace Mahngiel\Redbook\Markup;

/**
 * Class RedbookPresentation
 *
 * @package Mahngiel\Redbook\Markup
 */
class RedbookPresentation extends Presentation implements PresentationInterface {


    /**
     * Get tree starting HTML
     *
     * @return string
     */
    public function getTreeWrapperStart()
    {
        return '<ul class="tree-root">';
    }

    /**
     * Get tree closing HTML
     *
     * @return string
     */
    public function getTreeWrapperEnd()
    {
        return '</ul>';
    }

    /**
     * Tree key element start
     *
     * @return mixed
     */
    public function getItemObjectStart()
    {
        return '<li class="schema-key">';
    }

    /**
     * Tree key anchor start
     *
     * @param $keyName
     *
     * @return string
     */
    public function getItemAnchorStart( $keyName )
    {
        return '<a class="ajaxSchemaKey" data-schema="key" data-key="' . $keyName . '" href="' . REDBOOK_URI . 'key/' . $keyName . '">';
    }

    /**
     * Tree key icon
     *
     * @param $keyName
     *
     * @return string
     */
    public function getListItemIcon()
    {
        return '<i class="fa fa-key"></i> ';
    }

    /**
     * Tree key anchor end
     *
     * @return string
     */
    public function getItemAnchorEnd()
    {
        return '</a>';
    }

    /**
     * Namespace container list wrapper
     *
     * @param $key
     *
     * @return string
     */
    public function startChildContainer()
    {
        return '<li class="schema-namespace">';
    }

    /**
     * Namespace element anchor start
     *
     * @return mixed
     */
    public function getContainerAnchorStart()
    {
        return '<a href="#" class="schema-collapse">';
    }

    /**
     * Namespace element anchor end
     *
     * @return mixed
     */
    public function getContainerAnchorEnd()
    {
        return '</a>';
    }

    /**
     * Namespace element icon
     *
     * @return mixed
     */
    public function getChildContainerIcon()
    {
        return '<i class="fa fa-folder-o"></i> ';
    }

    /**
     * @return string
     */
    public function endChildContainer()
    {
        return '</li>';
    }

    /**
     * Namespace tree item wrapper
     *
     * @return string
     */
    public function startParentContainer()
    {
        return '<ul class="schema-container">';
    }

    /**
     * Namespace tree item wrapper end
     *
     * @return string
     */
    public function endParentContainer()
    {
        return '</ul>';
    }
}
