<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubTechnicalDesignResource\Pages;
use App\Filament\Resources\SubTechnicalDesignResource\RelationManagers;
use App\Filament\Resources\SubTechnicalDesignResource\Traits\SubTechnicalDesignFormTrait;
use App\Models\SubTechnicalDesign;
use App\Models\TechnicalDesign;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubTechnicalDesignResource extends Resource
{
    use SubTechnicalDesignFormTrait;

    protected static ?string $model = SubTechnicalDesign::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $label = 'Dokumen Rantek';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::subTechnicalDesignForm())->inlineLabel()->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            RelationManagers\WorkOrdersRelationManager::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubTechnicalDesigns::route('/'),
            'create' => Pages\CreateSubTechnicalDesign::route('/create'),
            'edit' => Pages\EditSubTechnicalDesign::route('/{record}/edit'),
        ];
    }
}
