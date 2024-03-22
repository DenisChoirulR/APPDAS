<?php

namespace App\Filament\Resources\SubTechnicalDesignResource\Traits;

use App\Enums\ActivityGroupEnum;
use App\Models\PlantingPattern;
use App\Models\TechnicalDesign;
use App\Models\WorkAreaBlockPlot;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;
use Filament\Support\RawJs;
use Filament\Forms;
use Illuminate\Contracts\Database\Eloquent\Builder;

trait Step2FormTrait
{
    protected static function step2Form(): array
    {
        return [
            self::step2PlantRepeater()
        ];
    }

    private static function step2PlantRepeater(): Forms\Components\Repeater
    {
        return TableRepeater::make('plant_types')
            ->label('Daftar Tanaman / Bibit')
            ->schema([
                Forms\Components\TextInput::make('plant_type_name')
                    ->label('Nama Tanaman / Bibit')
                    ->required()
                    ->string()
                    ->hiddenLabel()
            ])->dehydrated(false);
    }
}
