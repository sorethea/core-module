<?php

namespace Modules\Core\Filament\Resources\PermissionResource\Pages;

use Modules\Core\Filament\Resources\PermissionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPermission extends EditRecord
{
    protected static string $resource = PermissionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
