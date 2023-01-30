<?php

namespace Modules\Core\Filament\Resources\ModuleResource\Pages;

use Modules\Core\Filament\Resources\ModuleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Core\Models\Module;

class ListModules extends ListRecords
{
    protected static string $resource = ModuleResource::class;

    public function mount(): void
    {
        parent::mount();
        $this->loadModules();
    }

    protected function getActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }

    public function loadModules(): void{
        $modules = \Module::all();
        foreach ($modules as $module){
            $installed = false;
            if($module->getName()=="Core"){
                $installed = true;
            }
            Module::query()->firstOrCreate([
                'name'=>$module->getName(),
                'enabled'=>$module->isEnabled(),
                'installed'=>$installed,
            ]);
        }
        $this->render();
    }
}
