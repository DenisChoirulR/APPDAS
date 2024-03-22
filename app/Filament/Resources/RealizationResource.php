<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RealizationResource\Actions\DeleteItemAction;
use App\Filament\Resources\RealizationResource\Pages;
use App\Filament\Resources\RealizationResource\RelationManagers;
use App\Models\Realization;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use function Filament\Support\format_number;

class RealizationResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Realization::class;

    protected static ?string $label = 'Realisasi';
    protected static ?string $navigationGroup = 'Kontrak';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('work_order.work_order_number'),
                Forms\Components\TextInput::make('activity_category')
                    ->label('Grup Aktivitas'),
                Forms\Components\TextInput::make('realization_of_planting')
                    ->label('Realisasi Penanaman')
                    ->readOnly(),
            ])->inlineLabel()->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('work_order.work_order_number')
                    ->label('Nomor SPK')
                    ->searchable(),
                Tables\Columns\TextColumn::make('activity_category')
                    ->label('Grup Aktivitas'),
                Tables\Columns\TextColumn::make('planting_plan')
                    ->label('Rencana Tanam')
                    ->state(function (Realization $record){
                        return $record->work_order?->subTechnicalDesign->plants()->sum('number_of_plant');
                    })
                    ->formatStateUsing(fn($state) => format_number($state))
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('realization_of_planting')
                    ->label('Realisasi Tanam')
                    ->formatStateUsing(fn($state) => format_number($state))
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('percentage')
                    ->label('Persentase')
                    ->state(function ($record){
                        $planting_plan = $record->work_order?->subTechnicalDesign->plants()->sum('number_of_plant');
                        if($planting_plan > 0 && $record->realization_of_planting > 0){
                            return round(($record->realization_of_planting / $planting_plan) * 100, 2);
                        }

                        return 0;
                    })
                    ->suffix('%')
                    ->alignCenter()
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ItemsRelationManager::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRealizations::route('/'),
            'view' => Pages\ViewRealization::route('/{record}'),
            'edit' => Pages\EditRealization::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->hasRole('super_admin')){
            return parent::getEloquentQuery();
        }

        return parent::getEloquentQuery()->whereHas('work_order', function (Builder $query){
            $query->whereHas('contract', function ($query){
                $query->where('contractor_id', auth()->user()->contractor_id);
            });
        });
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'delete',
            'update'
        ];
    }
}
