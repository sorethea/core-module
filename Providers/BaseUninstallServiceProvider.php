<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;

class BaseUninstallServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app()->booted(function () {
            $this->uninstall();
        });
    }

    public function uninstall(){

    }

    protected function dropSchema($reverseMigrations = true)
    {
        if ($reverseMigrations) {
            $migrations = array_reverse($this->migrations);
        } else {
            $migrations = $this->migrations;
        }

        foreach ($migrations as $migration) {
            $migrationObject = new $migration();
            $migrationObject->down();
        }
    }
}
