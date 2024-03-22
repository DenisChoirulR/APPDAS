<?php

namespace App\Filament\Resources\WorkAreaResource\Traits;

use Filament\Forms;

trait WorkAreaBlockPlotFormTrait
{
    use PlantingPatternFormTrait;

    protected static function plotForm(): array
    {
        return [
            self::selectPattern(),
            self::inputPlot(),
            self::inputPlotSize()
        ];
    }

    private static function selectPattern(): Forms\Components\Select
    {
        return Forms\Components\Select::make('planting_pattern_id')
            ->label('Pola Tanam')
            ->relationship('pattern', 'pattern')
            ->native(false)
            ->createOptionForm(self::plantingPatternForm())
            ->required()
            ->hiddenLabel();
    }

    private static function inputPlot(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('plot')
            ->label('Petak')
            ->hiddenLabel()
            ->required()
            ->string()
            ->hiddenLabel();
    }

    private static function inputPlotSize(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('plot_size')
            ->label('Luas Petak')
            ->required()
            ->numeric()
            ->step('.01')
            ->suffix('Ha')
            ->hiddenLabel();
    }
}
