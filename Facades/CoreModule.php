<?php

namespace Modules\Core\Facades;

class CoreModule extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return \Modules\Core\Classes\CoreModule::class;
    }
}
