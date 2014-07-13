<?php namespace Mahngiel\Redbook\Markup;

class Writer {

    /**
     * @var Presentation
     */
    private $presentation = null;

    public function __construct()
    {
        $class= \Config::get('redbook::redbook.treeViewer');

        if( class_exists($class) )
        {
            $this->presentation = new $class;
        }
        else
        {
            throw new \Exception('no presenter');
        }
    }

    final public function render( array $schema, $namespaceSeparator )
    {
        return $this->presentation->getMarkupStart()
            . $this->presentation->getMarkupBody( $schema, $namespaceSeparator )
            . $this->presentation->getMarkupEnd();
    }
} 
