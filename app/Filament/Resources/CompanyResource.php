<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Filament\Resources\CompanyResource\Traits\CompanyFormTrait;
use App\Models\Company;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyResource extends Resource implements HasShieldPermissions
{
    use CompanyFormTrait;

    protected static ?string $model = Company::class;

//    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $label = 'Perusahaan';
    protected static ?string $navigationLabel = 'Perusahaan';

    protected static ?string $navigationGroup = 'Sumber Daya';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::contractorForm())
            ->inlineLabel()
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Perusahaan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->default('-'),
                Tables\Columns\TextColumn::make('tax_number')
                    ->default('-'),
                Tables\Columns\TextColumn::make('created_at')->date(),
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
            RelationManagers\IppkhRelationManager::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompany::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'view' => Pages\ViewCompany::route('/{record}'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view', 'view_any', 'create', 'update', 'delete'
        ];
    }
}
