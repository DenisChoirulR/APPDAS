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
use function Filament\Support\format_number;

trait Step3FormTrait
{
    protected static function step3Form(): array
    {
        return [
            self::step3P0Section(),
            self::step3P1Section(),
            self::step3P2Section(),
        ];
    }

    private static function step3P0Section(): Forms\Components\Fieldset
    {
        return Forms\Components\Fieldset::make(ActivityGroupEnum::P0->getLabel())
            ->schema([
                TableRepeater::make('plants_p0')
                    ->deletable(false)
                    ->addable(false)
                    ->hiddenLabel()
                    ->relationship('plants', function (Builder $query){
                        $query->where('activity_category', ActivityGroupEnum::P0->name);
                    })
                    ->schema([
                        Forms\Components\Hidden::make('activity_category')
                            ->default(ActivityGroupEnum::P0->name),
                        Forms\Components\TextInput::make('plant_name')
                            ->label('Nama Tanaman / Bibit')
                            ->readOnly()
                            ->required()
                            ->string()
                            ->hiddenLabel(),
                        Forms\Components\TextInput::make('number_of_plant')
                            ->numeric()
                            ->label('Jumlah Tanaman / Bibit')
                            ->placeholder('Masukan jumlah tanaman/bibit per hektar')
                            ->suffix(' / Ha')
                            ->required()
                            ->minValue(0)
                            ->hiddenLabel(),
                        Forms\Components\TextInput::make('price')
                            ->label('Harga Bibit')
                            ->placeholder('Masukan harga satuan tanaman/bibit')
                            ->prefix('Rp')
                            ->required()
                            ->hiddenLabel()
                            ->mask(RawJs::make(<<<'JS'
                                $money($input, ',', '.', 0)
                            JS))
                            ->live(onBlur: true)
                            ->dehydrateStateUsing(fn($state) => str($state)->replace('.', '')->toInteger()),
                        Forms\Components\Placeholder::make('total')
                            ->hiddenLabel()
                            ->content(function (Forms\Get $get){
                                $plant_price = str($get('price'))->replace('.', ',')->toInteger();
                                return 'Rp ' . format_number($plant_price * $get('number_of_plant'));
                            })
                    ])->inlineLabel(false)->columns(3)
            ])->columns(1);
    }

    private static function step3P1Section(): Forms\Components\Fieldset
    {
        return Forms\Components\Fieldset::make(ActivityGroupEnum::P1->getLabel())
            ->schema([
                TableRepeater::make('plants_p1')
                    ->deletable(false)
                    ->addable(false)
                    ->hiddenLabel()
                    ->relationship('plants', function (Builder $query){
                        $query->where('activity_category', ActivityGroupEnum::P1->name);
                    })
                    ->schema([
                        Forms\Components\Hidden::make('activity_category')
                            ->default(ActivityGroupEnum::P1->name),
                        Forms\Components\TextInput::make('plant_name')
                            ->label('Nama Tanaman / Bibit')
                            ->readOnly()
                            ->required()
                            ->string()
                            ->hiddenLabel(),
                        Forms\Components\TextInput::make('number_of_plant')
                            ->numeric()
                            ->label('Jumlah Tanaman / Bibit')
                            ->placeholder('Masukan jumlah tanaman/bibit per hektar')
                            ->suffix(' / Ha')
                            ->required()
                            ->minValue(0)
                            ->hiddenLabel(),
                        Forms\Components\TextInput::make('price')
                            ->label('Harga Bibit')
                            ->placeholder('Masukan harga satuan tanaman/bibit')
                            ->prefix('Rp')
                            ->required()
                            ->hiddenLabel()
                            ->mask(RawJs::make(<<<'JS'
                                $money($input, ',', '.', 0)
                            JS))
                            ->live(onBlur: true)
                            ->dehydrateStateUsing(fn($state) => str($state)->replace('.', '')->toInteger()),
                        Forms\Components\Placeholder::make('total')
                            ->hiddenLabel()
                            ->content(function (Forms\Get $get){
                                $plant_price = str($get('price'))->replace('.', ',')->toInteger();
                                return 'Rp ' . format_number($plant_price * $get('number_of_plant'));
                            })
                    ])->inlineLabel(false)->columns(3)
            ])->columns(1);
    }

    private static function step3P2Section(): Forms\Components\Fieldset
    {
        return Forms\Components\Fieldset::make(ActivityGroupEnum::P2->getLabel())
            ->schema([
                TableRepeater::make('plants_p2')
                    ->deletable(false)
                    ->addable(false)
                    ->hiddenLabel()
                    ->relationship('plants', function (Builder $query){
                        $query->where('activity_category', ActivityGroupEnum::P2->name);
                    })
                    ->schema([
                        Forms\Components\Hidden::make('activity_category')
                            ->default(ActivityGroupEnum::P2->name),
                        Forms\Components\TextInput::make('plant_name')
                            ->label('Nama Tanaman / Bibit')
                            ->readOnly()
                            ->required()
                            ->string()
                            ->hiddenLabel(),
                        Forms\Components\TextInput::make('number_of_plant')
                            ->numeric()
                            ->label('Jumlah Tanaman / Bibit')
                            ->placeholder('Masukan jumlah tanaman/bibit per hektar')
                            ->suffix(' / Ha')
                            ->required()
                            ->minValue(0)
                            ->hiddenLabel(),
                        Forms\Components\TextInput::make('price')
                            ->label('Harga Bibit')
                            ->placeholder('Masukan harga satuan tanaman/bibit')
                            ->prefix('Rp')
                            ->required()
                            ->hiddenLabel()
                            ->mask(RawJs::make(<<<'JS'
                                $money($input, ',', '.', 0)
                            JS))
                            ->live(onBlur: true)
                            ->dehydrateStateUsing(fn($state) => str($state)->replace('.', '')->toInteger()),
                        Forms\Components\Placeholder::make('total')
                            ->hiddenLabel()
                            ->content(function (Forms\Get $get){
                                $plant_price = str($get('price'))->replace('.', ',')->toInteger();
                                return 'Rp ' . format_number($plant_price * $get('number_of_plant'));
                            })
                    ])->inlineLabel(false)->columns(3)
            ])->columns(1);
    }
}
