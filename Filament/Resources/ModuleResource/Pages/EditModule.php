<?php

namespace Modules\Core\Filament\Resources\ModuleResource\Pages;

use Modules\Core\Filament\Resources\ModuleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditModule extends EditRecord
{
    protected static string $resource = ModuleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
