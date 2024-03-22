<?php

namespace App\Filament\Resources\CompanyResource\RelationManagers;

use App\Filament\Resources\IppkhResource;
use App\Filament\Resources\IppkhResource\Traits\IppkhFormTrait;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IppkhRelationManager extends RelationManager
{
    use IppkhFormTrait;

    protected static string $relationship = 'ippkh';
    protected static ?string $title = 'IPPKH';
    protected static ?string $label = 'IPPKH';

    public function form(Form $form): Form
    {
        return $form
            ->schema(self::formIppkh())
            ->inlineLabel()
            ->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('ippkh_license_number')
            ->columns([
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
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\Action::make('manage_ippkh')
                    ->label('Kelola IPPKH')
                    ->url(IppkhResource::getUrl())
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
