<?php

namespace App\Filament\Resources\SubTechnicalDesignResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkOrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'workOrders';

    protected static ?string $title = 'Perintah Kerja (SPK)';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('work_order_number')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('work_order_number')
            ->columns([
                Tables\Columns\TextColumn::make('contract.contract_number')
                    ->label('Nomor Kontrak'),
                Tables\Columns\TextColumn::make('work_order_number')
                    ->label('Nomor SPK'),
                Tables\Columns\TextColumn::make('work_order_date')
                    ->label('Tanggal SPK'),
                Tables\Columns\TextColumn::make('work_order_value')
                    ->label('Nilai SPK')
                    ->money('IDR'),
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
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make()
                ]),
            ]);
    }
}
