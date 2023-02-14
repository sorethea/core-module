<?php

namespace Modules\Core\Classes;

use Illuminate\Support\Facades\Artisan;

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
        $module = \Module::find($moduleName);
        $module->enable();
        app()->register(config("modules.namespace","Modules")."\\".$moduleName."\\".config("modules.paths.generator.provider","Providers")."\\InstallServiceProvider");
    }
    public function uninstall(string $moduleName):void {
        $module = \Module::find($moduleName);
        dd($module->get());
        Artisan::call("module:migrate-rollback ".$module->getName());
        $module->disable();
    }
    public function isCore(string $moduleName):bool {
        $class = \Core::getClass($moduleName);
        return $class =="core";
    }
}
