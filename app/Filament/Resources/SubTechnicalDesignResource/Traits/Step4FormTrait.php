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

trait Step4FormTrait
{
    protected static function step4Form(): array
    {
        return [
            self::step4P0Section(),
            self::step4P1Section(),
            self::step4P2Section(),
        ];
    }

    private static function step4P0Section(): Forms\Components\Fieldset
    {
        return Forms\Components\Fieldset::make(ActivityGroupEnum::P0->getLabel())
            ->schema([
                TableRepeater::make('socials_p0')
                    ->hiddenLabel()
                    ->addActionLabel('Tambah Aktifitas')
                    ->relationship('socials', function (Builder $query){
                        $query->where('activity_category', ActivityGroupEnum::P0->name);
                    })
                    ->schema([
                        Forms\Components\Hidden::make('activity_category')
                            ->default(ActivityGroupEnum::P0->name),
                        Forms\Components\TextInput::make('name_of_activity')
                            ->label('Nama Aktifitas Sosial')
                            ->required()
                            ->string()
                            ->hiddenLabel(),
                        Forms\Components\TextInput::make('quantity')
                            ->numeric()
                            ->label('Jumlah / Kuantitas')
                            ->required()
                            ->minValue(0)
                            ->hiddenLabel()
                    ])->inlineLabel(false)->columns(3)
            ])->columns(1);
    }

    private static function step4P1Section(): Forms\Components\Fieldset
    {
        return Forms\Components\Fieldset::make(ActivityGroupEnum::P1->getLabel())
            ->schema([
                TableRepeater::make('socials_p1')
                    ->hiddenLabel()
                    ->addActionLabel('Tambah Aktifitas')
                    ->relationship('socials', function (Builder $query){
                        $query->where('activity_category', ActivityGroupEnum::P1->name);
                    })
                    ->schema([
                        Forms\Components\Hidden::make('activity_category')
                            ->default(ActivityGroupEnum::P1->name),
                        Forms\Components\TextInput::make('name_of_activity')
                            ->label('Nama Aktifitas Sosial')
                            ->required()
                            ->string()
                            ->hiddenLabel(),
                        Forms\Components\TextInput::make('quantity')
                            ->numeric()
                            ->label('Jumlah / Kuantitas')
                            ->required()
                            ->minValue(0)
                            ->hiddenLabel()
                    ])->inlineLabel(false)->columns(3)
            ])->columns(1);
    }

    private static function step4P2Section(): Forms\Components\Fieldset
    {
        return Forms\Components\Fieldset::make(ActivityGroupEnum::P2->getLabel())
            ->schema([
                TableRepeater::make('socials_p2')
                    ->hiddenLabel()
                    ->addActionLabel('Tambah Aktifitas')
                    ->relationship('socials', function (Builder $query){
                        $query->where('activity_category', ActivityGroupEnum::P2->name);
                    })
                    ->schema([
                        Forms\Components\Hidden::make('activity_category')
                            ->default(ActivityGroupEnum::P2->name),
                        Forms\Components\TextInput::make('name_of_activity')
                            ->label('Nama Aktifitas Sosial')
                            ->required()
                            ->string()
                            ->hiddenLabel(),
                        Forms\Components\TextInput::make('quantity')
                            ->numeric()
                            ->label('Jumlah / Kuantitas')
                            ->required()
                            ->minValue(0)
                            ->hiddenLabel()
                    ])->inlineLabel(false)->columns(3)
            ])->columns(1);
    }
}
