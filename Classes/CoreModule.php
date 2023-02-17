<?php

namespace Modules\Core\Classes;

use Illuminate\Container\Container;
use Modules\Core\Installer\FileInstaller;
use Nwidart\Modules\Module;


class CoreModule extends Module
{
    protected $name;

    public function setName(string $name){
        $this->name = $name;
    }

    public function install(): void
    {
        $this->installer->install($this,true);
    }

    public function uninstall(): void
    {
        $this->installer->uninstall($this,false);
    }

    public function registerAliases(): void
    {

    }

    public function registerProviders(): void
    {

    }

    public function getCachedServicesPath(): string
    {

    }
}
