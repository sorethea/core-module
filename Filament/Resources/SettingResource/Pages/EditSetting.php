<?php

namespace Modules\Core\Filament\Resources\SettingResource\Pages;

use Modules\Core\Filament\Resources\SettingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSetting extends EditRecord
{
    protected static string $resource = SettingResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
