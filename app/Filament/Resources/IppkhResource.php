<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IppkhResource\Pages;
use App\Filament\Resources\IppkhResource\RelationManagers;
use App\Filament\Resources\IppkhResource\Traits\IppkhFormTrait;
use App\Models\Ippkh;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IppkhResource extends Resource
{
    use IppkhFormTrait;

    protected static ?string $model = Ippkh::class;

//    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $label = 'IPPKH';
    protected static ?string $navigationLabel = 'IPPKH';
    protected static ?string $navigationGroup = 'Sumber Daya';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::formIppkh())
            ->inlineLabel()
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company.name')
                    ->label('Perusahaan')
                    ->searchable()
                    ->url(fn(Ippkh $record) => CompanyResource::getUrl('view', ['record' => $record->company->id]))
                    ->weight(FontWeight::Bold)
                    ->color(Color::Green),
                Tables\Columns\TextColumn::make('ippkh_license_number')
                    ->label('SK. IPPKH')
                    ->searchable(),
                Tables\Columns\TextColumn::make('issue_date')
                    ->label('Tanggal SK'),
                Tables\Columns\TextColumn::make('area_size')
                    ->label('Luas Area')
                    ->suffix(' hektar'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
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
            RelationManagers\DasProjectsRelationManager::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIppkhs::route('/'),
            'create' => Pages\CreateIppkh::route('/create'),
            'edit' => Pages\EditIppkh::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
