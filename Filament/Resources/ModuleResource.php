<?php

namespace Modules\Core\Filament\Resources;

use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Support\Facades\Artisan;
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

                Action::make('enable')
                    ->requiresConfirmation()
                    ->modalHeading(fn($record)=>"Enable {$record->name} Module")
                    ->action(function ($record){
                        $module = \Module::find($record->name);
                        $module->enable();
                        $record->enabled = true;
                        $record->save();
                        redirect(request()->header("Referer"));
                    })
                    ->color("success")
                    //->icon('heroicon-o-check')
                    ->button()
                    ->visible(fn($record)=>!$record->enabled
                            && $record->installed
                            && auth()->user()->can("modules.manager")
                            && $record->name != "Core"),
                Action::make('disable')
                    ->requiresConfirmation()
                    ->modalHeading(fn($record)=>"Disable {$record->name} Module")
                    ->action(function ($record){
                        $module = \Module::find($record->name);
                        $module->disable();
                        $record->enabled = false;
                        $record->save();
                        redirect(request()->header("Referer"));
                    })
                    //->icon('heroicon-o-x')
                    ->button()
                    ->color("warning")
                    ->visible(fn($record)=>$record->enabled
                            && $record->installed
                            && auth()->user()->can("modules.manager")
                            && $record->name != "Core"),
                Action::make('installation')
                    ->requiresConfirmation()
                    ->modalHeading()
                    ->button()
                    ->color('primary')
                    ->visible(fn($record)=>!$record->installed
                        && auth()->user()->can("modules.manager"))
                    ->action(function ($record){
                        $module = \Module::find($record->name);
                        Artisan::call("module:migrate ".$module->getName());
                        Artisan::call("module:seed ".$module->getName());
                        $module->enable();
                        $record->enabled = $module->isEnabled();
                        $record->installed = true;
                        $record->save();
                        redirect(request()->header("Referer"));
                    }),
//                DeleteAction::make()
//                    ->icon(false)
//                    ->button()
//                    ->after(fn($record)=>Artisan::call("module:delete {$record->name}"))
//                    ->visible(fn($record)=>$record->name != "Core" && auth()->user()->can("modules.manager")),
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
