<?php

namespace App\Filament\Resources\WorkOrderResource\RelationManagers;

use App\Filament\Resources\WorkOrderPaymentResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';

    protected static ?string $label = 'Pembayaran';
    protected static ?string $title = 'Pembayaran';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('payment_step')
                    ->label('Jenis Pembayaran'),
                Tables\Columns\TextColumn::make('nominal')
                    ->label('Nominal Pembayaran')
                    ->prefix('Rp ')
                    ->numeric(0, ',', '.'),
                Tables\Columns\TextColumn::make('payment_date')
                    ->label('Tanggal')
                    ->date(),
                Tables\Columns\TextColumn::make('work_status')
                    ->label('Status Pekerjaan'),
                Tables\Columns\TextColumn::make('payment_status')
                    ->label('Status Pembayaran'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('detail')
                    ->url(fn($record) => WorkOrderPaymentResource::getUrl('view', [$record->id]))
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
