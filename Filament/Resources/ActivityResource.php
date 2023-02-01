<?php

namespace Modules\Core\Filament\Resources;

use Modules\Core\Filament\Resources\ActivityResource\Pages;
use Modules\Core\Filament\Resources\ActivityResource\RelationManagers;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Core\Tables\Columns\PopOver;
use Spatie\Activitylog\Models\Activity;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-eye';

    protected static function getNavigationGroup(): ?string
    {
        return config('core.navigation.name');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make("description"),
                    Forms\Components\TextInput::make("event"),
                    Forms\Components\TextInput::make("causer_id"),
                    Forms\Components\TextInput::make("causer_type"),
                    Forms\Components\TextInput::make("subject_id"),
                    Forms\Components\TextInput::make("subject_type"),
                    Forms\Components\KeyValue::make("properties.attributes")
                        ->label("Attributes")
                        ->keyLabel("Column")
                        ->valueLabel("Value"),
                    Forms\Components\KeyValue::make("properties.old")
                        ->label("Old")
                        ->keyLabel("Column")
                        ->valueLabel("Value"),
                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("description")
                    ->searchable(),
                Tables\Columns\TextColumn::make("event")
                    ->searchable(),
                Tables\Columns\TextColumn::make("causer.name")
                    ->searchable(),
                Tables\Columns\TextColumn::make("subject_id"),
                Tables\Columns\TextColumn::make("subject_type"),
                //Tables\Columns\TextColumn::make("changes"),
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
            'index' => Pages\ListActivities::route('/'),
//            'create' => Pages\CreateActivity::route('/create'),
//            'edit' => Pages\EditActivity::route('/{record}/edit'),
            'view' => Pages\ViewActivity::route('/{record}'),
        ];
    }
}
