<?php

namespace App\Filament\Resources;

use App\Exports\DasProjectReport;
use App\Exports\WorkOrderReport;
use App\Filament\Resources\DasProjectResource\Pages;
use App\Filament\Resources\DasProjectResource\RelationManagers;
use App\Filament\Resources\DasProjectResource\Traits\DasProjectFormTrait;
use App\Models\DasProject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class DasProjectResource extends Resource
{
    use DasProjectFormTrait;

    protected static ?string $model = DasProject::class;

//    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $label = 'SK DAS';
    protected static ?string $navigationLabel = 'SK DAS';

    protected static ?string $navigationGroup = 'Sumber Daya';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::dasProjectForm())
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
                    ->url(fn(DasProject $record) => CompanyResource::getUrl('view', ['record' => $record->company_id]))
                    ->weight(FontWeight::Bold)
                    ->color(Color::Green),
                Tables\Columns\TextColumn::make('location.name')
                    ->label('Lokasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sk_number')
                    ->label('Nomor SK')
                    ->searchable(),
                Tables\Columns\TextColumn::make('issue_date')
                    ->label('Tanggal')
                    ->date(),
                Tables\Columns\TextColumn::make('area_size')
                    ->label('Luas')
                    ->suffix(' Hektar'),
            ])
            ->defaultSort('created_at', 'desc')
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
                        ->action( fn (Collection $records) => Excel::download(new DasProjectReport($records), 'SK DAS Report.xlsx'))
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
            'index' => Pages\ListDasProjects::route('/'),
            'create' => Pages\CreateDasProject::route('/create'),
            'view' => Pages\ViewDasProject::route('/{record}'),
            'edit' => Pages\EditDasProject::route('/{record}/edit'),
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
