<?php

namespace Modules\Core\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\PluginServiceProvider;
use Modules\Core\Filament\Resources\ActivityResource;
use Modules\Core\Filament\Resources\ModuleResource;
use Modules\Core\Filament\Resources\PermissionResource;
use Modules\Core\Filament\Resources\RoleResource;
use Modules\Core\Filament\Resources\SettingResource;
use Modules\Core\Filament\Resources\UserResource;
use Spatie\LaravelPackageTools\Package;
use Modules\Core\Filament\Pages\CorePage;

class FilamentServiceProvider extends PluginServiceProvider
{
    public function isEnabled(): bool{
        $module = \Module::find('core');
        return $module->isEnabled();
    }
    protected array $pages = [];
    protected array $resources =[
        UserResource::class,
        RoleResource::class,
        PermissionResource::class,
        ActivityResource::class,
        ModuleResource::class,
        SettingResource::class,
    ];
    public function configurePackage(Package $package): void
    {
        $package->name('core');
    }

    public function getResources(): array
    {
        return ($this->isEnabled())?$this->resources:[];
    }

    public function getPages(): array
    {
        return ($this->isEnabled())?$this->pages:[];
    }

    public function boot()
    {
        Filament::serving(function (){
            if(config('core.navigation.enabled'))
            Filament::registerNavigationGroups([
                NavigationGroup::make()
                    ->label(config('core.navigation.name'))
                    ->icon('heroicon-m-adjustments')
            ]);
        });
        return parent::boot();
    }
}
