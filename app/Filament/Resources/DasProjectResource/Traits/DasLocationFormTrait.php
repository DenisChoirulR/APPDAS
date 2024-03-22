<?php

namespace App\Filament\Resources\DasProjectResource\Traits;

use Filament\Forms;
trait DasLocationFormTrait
{
    protected static function dasLocationForm(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->required()
                ->string()
                ->unique('das_locations', 'name', ignoreRecord: true)
                ->maxLength(255)
                ->inlineLabel()
        ];
    }
}
