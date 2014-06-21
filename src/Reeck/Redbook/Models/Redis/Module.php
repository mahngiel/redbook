<?php namespace Reeck\Redbook\Models\Redis;

use Reeck\Redbook\Support\Redis;

class Module extends Redis {

    protected $database = 'redbook';

    protected $schema = array(
        'all'       => "modules", // set of all module areas
        'moduleKey' => "modules:nextId", // counter
        'object'    => "modules:%s", // hash of area by slug
        'areas'     => "modules:%s:areas", // set of assigned modules to area
    );
}
