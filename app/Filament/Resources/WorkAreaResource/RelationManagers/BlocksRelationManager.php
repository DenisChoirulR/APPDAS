<?php

namespace App\Filament\Resources\WorkAreaResource\RelationManagers;

use App\Filament\Resources\WorkAreaResource\Traits\WorkAreaBlockFormTrait;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlocksRelationManager extends RelationManager
{
    use WorkAreaBlockFormTrait;

    protected static string $relationship = 'blocks';
    protected static ?string $title = 'Daftar Blok';
    protected static ?string $label = 'Blok';

    public function form(Form $form): Form
    {
        return $form
            ->schema(self::blockForm())
            ->inlineLabel()
            ->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('block_name')
            ->columns([
                Tables\Columns\TextColumn::make('block_name')
                    ->label('Nama Blok'),
                Tables\Columns\TextColumn::make('block_size')
                    ->label('Luas Blok')
                    ->suffix(' Hektar'),
                Tables\Columns\TextColumn::make('plots_count')
                    ->counts('plots')
                    ->label('Jumlah Petak')
                    ->suffix(' Petak'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalWidth('7xl'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
