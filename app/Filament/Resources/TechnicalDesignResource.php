<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TechnicalDesignResource\Pages;
use App\Filament\Resources\TechnicalDesignResource\RelationManagers;
use App\Filament\Resources\TechnicalDesignResource\Traits\TechnicalDesignFormTrait;
use App\Models\TechnicalDesign;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TechnicalDesignResource extends Resource
{
    use TechnicalDesignFormTrait;

    protected static ?string $model = TechnicalDesign::class;

//    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $label = 'Rancangan Teknis';

    protected static ?int $navigationSort = 11;

    protected static ?string $navigationGroup = 'Proyek';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::technicalDesignForm())
            ->inlineLabel()
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Rantek')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company.name')
                    ->label('Perusahaan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('das_project.sk_number')
                    ->label('SK DAS')
                    ->searchable(),
                Tables\Columns\TextColumn::make('work_area.code')
                    ->label('Area Kerja')
                    ->searchable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\SubTechnicalDesignRelationManager::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTechnicalDesigns::route('/'),
            'create' => Pages\CreateTechnicalDesign::route('/create'),
            'view' => Pages\ViewTechnicalDesign::route('/{record}'),
            'edit' => Pages\EditTechnicalDesign::route('/{record}/edit'),
        ];
    }
}
