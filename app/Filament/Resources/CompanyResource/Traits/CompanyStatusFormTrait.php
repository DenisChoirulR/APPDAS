<?php

namespace App\Filament\Resources\CompanyResource\Traits;

use Filament\Forms;
trait CompanyStatusFormTrait
{
    protected static function companyStatusForm(): array
    {
        return [
            Forms\Components\TextInput::make('status')
                ->required()
                ->string()
                ->maxLength(100)
                ->inlineLabel(),
            Forms\Components\TextInput::make('description')
                ->label('Keterangan')
                ->inlineLabel()
                ->nullable()
                ->string()
                ->maxLength(255),
        ];
    }
}
