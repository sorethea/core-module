<?php

namespace Modules\Core\Filament\Resources\UserResource\Pages;

use Modules\Core\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
