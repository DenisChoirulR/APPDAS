<?php

namespace App\Filament\Resources\IppkhResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DasProjectsRelationManager extends RelationManager
{
    protected static string $relationship = 'dasProjects';

    protected static ?string $title = 'SK DAS';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('code')
            ->columns([
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
