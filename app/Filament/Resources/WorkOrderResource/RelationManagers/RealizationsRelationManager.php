<?php

namespace App\Filament\Resources\WorkOrderResource\RelationManagers;

use App\Enums\ActivityGroupEnum;
use App\Filament\Resources\RealizationResource;
use App\Models\Realization;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use function Filament\Support\format_number;

class RealizationsRelationManager extends RelationManager
{
    protected static string $relationship = 'realizations';

    protected static ?string $title = 'Realisasi';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('activity_category')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('activity_category')
            ->columns([
                Tables\Columns\TextColumn::make('activity_category')
                    ->label('Grup Aktivitas'),
                Tables\Columns\TextColumn::make('planting_plan')
                    ->label('Rencana Tanam')
                    ->state(function (Realization $record){
                        return $record->work_order
                            ->subTechnicalDesign
                            ->plants()
                            ->where('activity_category', ActivityGroupEnum::P0->name)
                            ->sum('number_of_plant');
                    })
                    ->formatStateUsing(fn($state) => format_number($state))
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('realization_of_planting')
                    ->label('Realisasi Tanam')
                    ->formatStateUsing(fn($state) => format_number($state))
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('percentage')
                    ->label('Persentase')
                    ->state(function ($record){
                        $planting_plan = $record->work_order
                            ->subTechnicalDesign
                            ->plants()
                            ->where('activity_category', ActivityGroupEnum::P0->name)
                            ->sum('number_of_plant');
                        if($planting_plan > 0 && $record->realization_of_planting > 0){
                            return round(($record->realization_of_planting / $planting_plan) * 100, 2);
                        }

                        return 0;
                    })
                    ->suffix('%')
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('status')
                    ->default('Belum ada status')
                    ->alignCenter(),
            ])
            ->paginated(false)
            ->actions([
                Tables\Actions\Action::make('view_realization')
                    ->label('Detail')
                    ->url(fn($record) => RealizationResource::getUrl('view', ['record' => $record->id]))
                    ->icon('heroicon-m-eye')
            ]);
    }
}
