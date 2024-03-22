<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CooperativeContractResource\Pages;
use App\Filament\Resources\CooperativeContractResource\RelationManagers;
use App\Filament\Resources\CooperativeContractResource\Traits\CooperativeContractFormTrait;
use App\Models\CooperativeContract;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CooperativeContractResource extends Resource
{
    use CooperativeContractFormTrait;

    protected static ?string $model = CooperativeContract::class;

    protected static ?string $label = 'Kontrak Kerjasama';

    protected static ?string $navigationGroup = 'Kontrak';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::cooperativeContractForm())
            ->inlineLabel()
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company.name')
                    ->label('Perusahaan'),
                Tables\Columns\TextColumn::make('contractor.company_name')
                    ->label('Kontraktor'),
                Tables\Columns\TextColumn::make('contract_number')
                    ->label('Nomor Kontrak'),
                Tables\Columns\TextColumn::make('contract_date')
                    ->date()
                    ->label('Tanggal Kontrak'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
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
            'index' => Pages\ListCooperativeContracts::route('/'),
            'create' => Pages\CreateCooperativeContract::route('/create'),
            'view' => Pages\ViewCooperativeContract::route('/{record}'),
            'edit' => Pages\EditCooperativeContract::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->hasRole('super_admin')){
            return parent::getEloquentQuery()->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
        }

        return parent::getEloquentQuery()
            ->where('contractor_id', auth()->user()->contractor_id)
                ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
