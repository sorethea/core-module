<?php

namespace Modules\Core\Filament\Resources\ModuleResource\Pages;

use Modules\Core\Filament\Resources\ModuleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateModule extends CreateRecord
{
    protected static string $resource = ModuleResource::class;
}
