<?php

namespace Modules\Core\Filament\Resources\ModuleResource\Pages;

use Illuminate\Support\Facades\Artisan;
use Modules\Core\Classes\CoreModule;
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
        $name_modules = [];
        $installed_modules = [];
        foreach ($modules as $module){
            $name = $module->getName();

            $name_modules[] = $name;
            $installed_modules[$name] = false;
            $class = $module->get("class");
            $model = Module::query()->firstOrCreate([
                'name'=>$module->getName(),
            ]);
            $enabled = $module->isEnabled();
            if( $enabled && !\Core::isCore($module->getName())){
                $module->disable();
            }
            //$model->enabled = $module->isEnabled();
//            if($class=='core' && !$model->installed){
//                $model->installed = true;
//            }
            //$model->class = $class;
            $model->save();
        }
        $table_modules = Module::all()->pluck("name")->toArray();

        $diff = array_diff($table_modules,$name_modules);
        if(!empty($diff)){
            foreach ($diff as $name){
                Module::where("name",$name)->delete();
            }
        }
        $this->render();
    }
}
