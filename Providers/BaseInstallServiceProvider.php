<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;

class BaseInstallServiceProvider extends ServiceProvider
{
    protected $migrations = [];
    protected $module_public_path = '';


    public function boot()
    {
        app()->booted(function () {
            $this->install();
            $this->installPublicAssets();
            \Artisan::call("cache:clear");
        });
    }

    public function install(){

    }
    protected function migrate(){
        foreach ($this->migrations as $migration){
            $migrationObj = new $migration();
            $migrationObj->up();
        }
    }

    protected function installPublicAssets()
    {
        $filesystem = new Filesystem();

        $modulePublicPath = $this->module_public_path;

        if (!empty($modulePublicPath) && $filesystem->exists($modulePublicPath)) {
            $filesystem->copyDirectory($modulePublicPath, public_path('/'));
        }
    }
}
