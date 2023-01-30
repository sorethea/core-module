<?php

namespace Modules\Core\Filament\Resources;

use Modules\Core\Filament\Resources\ModuleResource\Pages;
use Modules\Core\Filament\Resources\ModuleResource\RelationManagers;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Core\Models\Module;

class ModuleResource extends Resource
{
    protected static ?string $model = Module::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static function getNavigationGroup(): ?string
    {
        return config('core.navigation.name');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")->searchable(),
                Tables\Columns\BooleanColumn::make("enabled"),
                Tables\Columns\BooleanColumn::make("installed"),
            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListModules::route('/'),
            //'create' => Pages\CreateModule::route('/create'),
            //'edit' => Pages\EditModule::route('/{record}/edit'),
        ];
    }
}
