<?php

namespace App\Filament\Resources\WorkAreaResource\Traits;

use Awcodes\FilamentTableRepeater\Components\TableRepeater;
use Filament\Forms;
trait WorkAreaBlockFormTrait
{
    use WorkAreaBlockPlotFormTrait;

    protected static function blockForm(): array
    {
        return [
            self::inputBlockName(),
            self::inputBlockSize(),
            self::plotRelation()
        ];
    }

    private static function inputBlockName(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('block_name')
            ->label('Nama Blok')
            ->required()
            ->string()
            ->maxLength(100);
    }

    private static function inputBlockSize(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('block_size')
            ->label('Luas Blok')
            ->suffix('Hektar')
            ->numeric()
            ->step('.01')
            ->required();
    }

    private static function plotRelation(): TableRepeater
    {
        return TableRepeater::make('plots')
            ->label('Petak')
            ->hiddenOn(['create'])
            ->relationship('plots')
            ->schema(self::plotForm());
    }

}
