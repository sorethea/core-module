<?php

namespace Modules\Core\Classes;

class Core
{
    public function getClass(string $moduleName):string{
        $module = \Module::find($moduleName);
        $json = json_decode(file_get_contents($module->getPath()."/module.json"), true);
        return $json['class']??'module';
    }
    public function getVersion(string $moduleName):string{
        $module = \Module::find($moduleName);
        $json = json_decode(file_get_contents($module->getPath()."/module.json"), true);
        return $json['version']??'dev';
    }

    public function install(string $moduleName):void {

    }
    public function uninstall(string $moduleName):void {

    }
    public function isCore(string $moduleName):bool {
        $class = \Core::getClass($moduleName);
        return $class =="core";
    }
}
