<?php

namespace Modules\Core\Facades;

use Illuminate\Support\Facades\Facade;

class Module extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Modules\Core\Classes\Module::class;
    }
}
