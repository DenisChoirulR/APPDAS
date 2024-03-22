<?php

namespace App\Filament\Resources;

use App\Exports\ContractorGeneralReport;
use App\Filament\Resources\ContractorResource\Pages;
use App\Filament\Resources\ContractorResource\RelationManagers;
use App\Filament\Resources\ContractorResource\Traits\ContractorFormTrait;
use App\Models\Contractor;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ContractorResource extends Resource implements HasShieldPermissions
{
    use ContractorFormTrait;

    protected static ?string $model = Contractor::class;

//    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $label = 'Kontraktor';
    protected static ?string $navigationGroup = 'Kontrak';

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
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode'),
                Tables\Columns\TextColumn::make('company_name')
                    ->label('Nama Kontraktor'),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telepon'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),
                Tables\Columns\TextColumn::make('director')
                    ->label('Direktur'),
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
                    ExportBulkAction::make()
                        ->action( fn (Collection $records) => Excel::download(new ContractorGeneralReport($records), 'General Report.xlsx'))
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
            'index' => Pages\ListContractors::route('/'),
            'create' => Pages\CreateContractor::route('/create'),
            'view' => Pages\ViewContractor::route('/{record}'),
            'edit' => Pages\EditContractor::route('/{record}/edit'),
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
