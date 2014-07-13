<?php namespace Mahngiel\Redbook\Markup;

/**
 * Class Presentation
 *
 * @package Mahngiel\Redbook\Markup
 */
abstract class Presentation {

    /**
     * @var
     */
    private $namespaceSeparator;

    /**
     * Generate schema tree HTML
     *
     * @param mixed $dataSet
     *
     * @return string
     */
    public function getTreeItems( $dataSet )
    {
        return $this->makeRedisSchemaTree( $dataSet );
    }

    /**
     * Get schema starting HTML
     *
     * @return string
     */
    abstract public function getTreeWrapperStart();

    /**
     * Get schema closing HTML
     *
     * @return string
     */
    abstract public function getTreeWrapperEnd();

    /**
     * @return string
     */
    public function getMarkupStart()
    {
        return $this->getTreeWrapperStart();
    }

    /**
     * @return string
     */
    public function getMarkupEnd()
    {
        return $this->getTreeWrapperEnd();
    }

    /**
     * @param mixed $dataSet
     *
     * @return string
     */
    public function getMarkupBody( $dataSet, $namespaceSeparator )
    {
        $this->namespaceSeparator = $namespaceSeparator;

        return $this->getTreeItems( $dataSet );
    }

    /**
     * Generate HTML for a list item
     * @param $keyName
     *
     * @return string
     */
    protected function generateListItem( $keyName )
    {
        return 
            $this->getItemObjectStart()
            . $this->getItemAnchorStart( $keyName )
            . $this->getListItemIcon()
            . $keyName
            . $this->getItemAnchorEnd();
    }

    /**
     * Generate HTML for a list container
     *
     * @param       $key
     * @param array $tree
     * @param       $namespace
     *
     * @return string
     */
    protected function generateChildContainer( $key, array $tree, $namespace )
    {
        return
            $this->startChildContainer()
            . $this->getContainerAnchorStart()
            . $this->getChildContainerIcon()
            . $key
            . $this->getContainerAnchorEnd()
            . $this->startParentContainer()
            . $this->makeRedisSchemaTree( $tree, false, $namespace )
            . $this->endParentContainer()
            . $this->endChildContainer();
    }

    /**
     * @param array $tree
     * @param bool  $newRound
     * @param null  $oldWord
     *
     * @return string
     */
    public function makeRedisSchemaTree( array $tree, $newRound = true, $oldWord = null )
    {
        $out = '';

        // Reapply namespace separator
        if ($oldWord)
        {
            $oldWord .= $this->namespaceSeparator;
        }

        // Run through the tree
        foreach ($tree as $namespace => $key)
        {
            // Generate HTML for container
            if (is_array( $key ))
            {
                $out .= $this->generateChildContainer( $namespace, $tree[$namespace], $oldWord . $namespace );
            }
            // Generate HTML for a key
            else
            {
                $out .= $this->generateListItem( $oldWord . $key );
            }
        }

        return $out . $this->endChildContainer();
    }
} 
