<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;

class BaseInstallServiceProvider extends ServiceProvider
{

    protected $module_public_path = '';


    public function boot()
    {
        app()->booted(function () {
            $this->booted();
            $this->installPublicAssets();
            \Cache::flush();
        });
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
