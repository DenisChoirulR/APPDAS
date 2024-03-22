<?php

namespace App\Filament\Resources\WorkOrderResource\RelationManagers;

use App\Filament\Resources\VerificationResource;
use App\Filament\Resources\WorkOrderResource\Actions\CreateVerification;
use App\Models\Realization;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VerificationsRelationManager extends RelationManager
{
    protected static string $relationship = 'verifications';

    protected static ?string $title = 'Verifikasi';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('percentage')
                    ->required()
                    ->numeric()
                    ->maxValue(100)
                    ->minValue(1)
                    ->suffix('%')
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Verifikasi')
                    ->date(),
                Tables\Columns\TextColumn::make('realization.activity_category')
                    ->label('Grup Aktivitas'),
                Tables\Columns\TextColumn::make('percentage')
                    ->label('Persentase')
                    ->suffix('%'),
                Tables\Columns\TextColumn::make('status'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make()
                    ->url(fn($record) => VerificationResource::getUrl('view', [$record->id])),
            ]);
    }
}
