<?php

namespace Modules\Core\Classes;

use Illuminate\Container\Container;
use Modules\Core\Installer\FileInstaller;
use Nwidart\Modules\Module;


class CoreModule extends Module
{
    protected $installer;

    public function __construct(string $name)
    {
        $app = app();
        $this->installer = $app[FileInstaller::class];
        $path = module_path($name);
        parent::__construct($app, $name, $path);
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
