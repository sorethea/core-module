<?php

namespace Modules\Core\Classes;

use Modules\Core\Models\Module;
use Nwidart\Modules\Laravel\LaravelFileRepository;

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

    public function install(string $moduleName):void {
        try {
            \DB::beginTransaction();
            $module = \Module::find($moduleName);
            $module->enable();
            app()->register($this->getModuleProviderNamespace($moduleName)."\\InstallServiceProvider");
            $moduleObj = Module::firstOrCreate(["name" => $moduleName]);
            \DB::commit();
        }catch (\Exception $exception){
            \DB::rollBack();
        }

        //$moduleObj->installed = true;
        //$moduleObj->save();
    }
    public function uninstall(string $moduleName):void {
        $module = \Module::find($moduleName);
        $module->disable();
        app()->register($this->getModuleProviderNamespace($moduleName)."\\UninstallServiceProvider");
        $moduleObj = Module::firstOrCreate(["name" => $moduleName]);
        //$moduleObj->installed = false;
        //$moduleObj->save();
    }
    public function isCore(string $moduleName):bool {
        return \Module::find($moduleName)->get("class","module") =="core";
    }

}
