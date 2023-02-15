<?php

namespace Modules\Core\Classes;

use Illuminate\Support\Facades\Artisan;
use Modules\Core\Models\Module;

class Core
{
    public function getModuleNamespace(){
        return config("modules.namespace","Modules");
    }
    public function getModuleProviderPath(){
        return config("modules.paths.generator.provider.path","Providers");
    }
    public function getModuleProviderNamespace($moduleName) :string{
        return $this->getModuleNamespace()."\\".$moduleName."\\".$this->getModuleProviderPath();
    }
    public function getClass(string $moduleName):string{
        $this->getModuleData($moduleName);
        return $json['class']??'module';
    }
    public function getVersion(string $moduleName):string{

        $json = $this->getModuleData($moduleName);
        return $json['version']??'dev';
    }

    public function getModuleData(string $moduleName): array{
        $module = \Module::find($moduleName);
        dd($module->getPath());
        return json_decode(file_get_contents($module->getPath()."/module.json"), true);
    }

    public function getRequirements(string $moduleName):array{
        $json = $this->getModuleData($moduleName);
        return $json['requirements']??[];
    }

    public function install(string $moduleName):void {
        $module = \Module::find($moduleName);
        $module->enable();
        app()->register($this->getModuleProviderNamespace($moduleName)."\\InstallServiceProvider");
        $moduleObj = Module::firstOrCreate(["name" => $moduleName]);
        $moduleObj->installed = true;
        $moduleObj->save();
    }
    public function uninstall(string $moduleName):void {
        $module = \Module::find($moduleName);
        $module->disable();
        app()->register($this->getModuleProviderNamespace($moduleName)."\\UninstallServiceProvider");
        $moduleObj = Module::firstOrCreate(["name" => $moduleName]);
        $moduleObj->installed = false;
        $moduleObj->save();
    }
    public function isCore(string $moduleName):bool {
        $class = \Core::getClass($moduleName);
        return $class =="core";
    }

}
