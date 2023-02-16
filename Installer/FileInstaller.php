<?php

namespace Modules\Core\Installer;
use Illuminate\Config\Repository as Config;
use Illuminate\Container\Container;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Cache\CacheManager;
use Modules\Core\Contracts\InstallerInterface;
use Nwidart\Modules\Module;

class FileInstaller implements InstallerInterface
{

    /**
     * @var Filesystem|mixed
     */
    private Filesystem $files;


    /**
     * @var Config|\config|mixed
     */
    private Config $config;


    /**
     * @var CacheManager|mixed
     */
    private CacheManager $cache;

    /**
     * @var string
     */
    private string $cacheKey;

    /**
     * @var string
     */
    private string $cacheLifetime;

    /**
     * @var array
     */
    private array $installedModules;

    /**
     * @var string
     */
    private string $installedModulesFile;


    public function __construct(Container $app)
    {
        $this->files = $app["files"];
        $this->config = $app["config"];
        $this->cache = $app["cache"];
        $this->installedModulesFile = $this->config("name",base_path('installed_modules.json'));
        $this->cacheKey = $this->config('cache-key');
        $this->cacheLifetime = $this->config('cache-lifetime');
        $this->installedModules = $this->getInstalledModules();
    }

    public function install(Module $module): void
    {
        $this->setInstalledByName($module->getName(),true);
    }

    public function uninstall(Module $module): void
    {
        $this->setInstalledByName($module->getName(),false);
    }

    public function setInstalled(Module $module, bool $installed): void
    {
        $this->setInstalledByName($module->getName(), $installed);
    }

    private function setInstalledByName(string $name, bool $installed)
    {
        $this->installedModules[$name] = $installed;
        $this->writeInstallModulesJson();
        $this->flushCache();
    }

    /**
     * @param string $key
     * @param $default
     * @return array|mixed
     */

    private function config(string $key, $default = null): mixed
    {
        return $this->config->get('core.installed-modules.file.' . $key, $default);
    }

    private function flushCache(): void
    {
        $this->cache->store($this->config->get('core.cache.driver'))->forget($this->cacheKey);
    }

    /**
     * @return array
     * @throws FileNotFoundException
     */
    private function getInstalledModules():array
    {
        if (!$this->config->get('core.cache.enabled')) {
            return $this->readInstallModulesJson();
        }

        return $this->cache->store($this->config->get('core.cache.driver'))->remember($this->cacheKey, $this->cacheLifetime, function () {
            return $this->readInstallModulesJson();
        });
    }

    /**
     * @return void
     */
    private function writeInstallModulesJson(): void
    {
        dd($this->installedModulesFile);
        $this->files->put($this->installedModulesFile, json_encode($this->installedModules, JSON_PRETTY_PRINT));
    }

    /**
     * @return array|mixed
     * @throws FileNotFoundException
     */
    private function readInstallModulesJson(): array
    {
        if (!$this->files->exists($this->installedModulesFile)) {
            return [];
        }
        dd($this->installedModulesFile);

        return json_decode($this->files->get($this->installedModulesFile), true);
    }
}
