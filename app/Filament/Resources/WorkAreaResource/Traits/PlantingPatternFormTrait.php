<?php

namespace App\Filament\Resources\WorkAreaResource\Traits;

use Filament\Forms;
trait PlantingPatternFormTrait
{
    protected static function plantingPatternForm(): array
    {
        return [
            self::inputPattern()
        ];
    }

    private static function inputPattern(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('pattern')
            ->label('Pola')
            ->required()
            ->string()
            ->inlineLabel();
    }
}
