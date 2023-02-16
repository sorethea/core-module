<?php

namespace Modules\Core\Classes;

use Illuminate\Container\Container;
use Modules\Core\Installer\FileInstaller;
use Nwidart\Modules\Module;


class CoreModule
{
    /**
     * @var Container
     */
    protected Container $app;

    protected Module $module;

    private mixed $files;
    /**
     * @var \Illuminate\Cache\CacheManager|mixed
     */
    private mixed $cache;
    /**
     * @var mixed|FileInstaller
     */
    private mixed $installer;


    public function __construct(Container $app, Module $module)
    {
        $this->module = $module;

        $this->cache = $app['cache'];
        $this->files = $app['files'];
        $this->installer = $app[FileInstaller::class];
        $this->app = $app;
    }

    public function install(): void
    {
        $this->install($this->module,true);
    }

    public function uninstall(): void
    {
        $this->uninstall($this->module,false);
    }
}
