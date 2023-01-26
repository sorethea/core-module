<?php

namespace Modules\Core\Filament\Resources\ActivityResource\Pages;

use Modules\Core\Filament\Resources\ActivityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditActivity extends EditRecord
{
    protected static string $resource = ActivityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
