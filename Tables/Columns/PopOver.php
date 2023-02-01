<?php

namespace Modules\Core\Tables\Columns;

use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\Column;

class PopOver extends Column
{
    protected string $view = 'core::tables.columns.pop-over';
    public function getState()
    {
        return Action::make("popover")
            ->label("Details");
    }
}
