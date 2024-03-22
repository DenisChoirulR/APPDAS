<?php

namespace App\Filament\Resources\DasProjectResource\RelationManagers;

use App\Filament\Resources\CompanyResource;
use App\Models\Ippkh;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IppkhRelationManager extends RelationManager
{
    protected static string $relationship = 'ippkh';
    protected static ?string $title = 'IPPKH';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('ippkh_license_number')
                    ->required()
                    ->maxLength(255),
            ]);
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
                Tables\Actions\AttachAction::make()
            ])
            ->actions([
                Tables\Actions\DetachAction::make()
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make()
            ]);
    }
}
