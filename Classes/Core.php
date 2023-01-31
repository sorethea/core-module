<?php

namespace Modules\Core\Classes;

class Core
{
    public function getType($moduleName):string{
        $type = 'module';
        $module = \Module::find($moduleName);
        dd($json = json_decode(file_get_contents($module->getPath()."module.json"), true));
        return $type;
    }
}
