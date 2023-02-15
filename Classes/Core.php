<?php

namespace Modules\Core\Classes;

use Illuminate\Container\Container;
use Illuminate\Support\Facades\Artisan;
use Modules\Core\Models\Module;

class Core extends \Nwidart\Modules\Module
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

    public function getClass(){
        return $this->get("class");
    }

    public function getRequirements(){
        return $this->get("requirements");
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
        return $this->get("class") =="core";
    }

    public function registerAliases(): void
    {
        // TODO: Implement registerAliases() method.
    }

    public function registerProviders(): void
    {
        // TODO: Implement registerProviders() method.
    }

    public function getCachedServicesPath(): string
    {
        // TODO: Implement getCachedServicesPath() method.
    }
}
