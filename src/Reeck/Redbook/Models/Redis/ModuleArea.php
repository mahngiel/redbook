<?php namespace Reeck\Redbook\Models\Redis;

use Reeck\Redbook\Support\Redis;

class ModuleArea extends Redis {

    protected $database = 'redbook';

    protected $schema = array(
        'all'       => "moduleAreas", // set of all module areas
        'moduleKey' => "moduleAreas:nextId", // counter
        'object'    => "moduleAreas:%s", // hash of area by slug
        'modules'   => "moduleAreas:%s:modules", // set of assigned modules to area
    );
}
