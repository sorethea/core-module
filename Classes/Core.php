<?php

namespace Modules\Core\Classes;

class Core
{
    public function getClass($moduleName):string{
        $module = \Module::find($moduleName);
        $json = json_decode(file_get_contents($module->getPath()."/module.json"), true);
        return $json['class']??'module';
    }
}
