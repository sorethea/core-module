<?php

namespace Modules\Core\Classes;

class Core
{
    public function getType($moduleName):string{
        $type = 'module';
        $module = \Module::find($moduleName);
        dd($module->getPath());
        return $type;
    }
}
