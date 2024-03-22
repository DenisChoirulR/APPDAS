<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkAreaResource\Pages;
use App\Filament\Resources\WorkAreaResource\RelationManagers;
use App\Filament\Resources\WorkAreaResource\Traits\WorkAreaFormTrait;
use App\Models\WorkArea;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkAreaResource extends Resource
{
    use WorkAreaFormTrait;

    protected static ?string $model = WorkArea::class;

//    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 10;

    protected static ?string $label = 'Area Kerja';

    protected static ?string $navigationGroup = 'Proyek';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::workAreaForm())
            ->inlineLabel()
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('das_project.sk_number')
                    ->label('SK DAS')
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('blocks_count')
                    ->counts('blocks')
                    ->label('Jumlah Blok')
                    ->alignCenter(),
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
            RelationManagers\BlocksRelationManager::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkAreas::route('/'),
            'create' => Pages\CreateWorkArea::route('/create'),
            'view' => Pages\ViewWorkArea::route('/{record}'),
            'edit' => Pages\EditWorkArea::route('/{record}/edit'),
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
