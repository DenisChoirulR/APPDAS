<?php

namespace App\Filament\Resources\SubTechnicalDesignResource\Traits;

use App\Models\TechnicalDesign;
use App\Models\WorkAreaBlockPlot;
use Filament\Support\RawJs;
use Filament\Forms;

trait Step1FormTrait
{
    protected static function step1Form(): array
    {
        return [
            self::stepOneSelectTechnicalDesign(),
            self::stepOneInputDocumentNumber(),
            self::stepOneSelectWorkAreaBlock(),
            self::stepOneSelectWorkAreaBlockPlot(),
            self::stepOneInputValueAmount()
        ];
    }

    private static function stepOneSelectTechnicalDesign(): Forms\Components\Hidden
    {
        return Forms\Components\Hidden::make('technical_design_id')
            ->required()
            ->default(function (){
                if(TechnicalDesign::find(request('technical-design'))){
                    return request('technical-design');
                }
                return null;
            });
    }

    private static function stepOneInputDocumentNumber(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('document_number')
            ->label('Nomor Dokumen')
            ->required()
            ->string(255);
    }

    private static function stepOneSelectWorkAreaBlock(): Forms\Components\Select
    {
        return Forms\Components\Select::make('work_area_block_id')
            ->label('Blok')
            ->options(function (Forms\Get $get){
                return TechnicalDesign::find($get('technical_design_id'))
                    ->work_area->blocks()->pluck('block_name', 'id');
            })
            ->required()
            ->native(false)
            ->live()
            ->afterStateUpdated(fn(Forms\Set $set) => $set('work_area_block_plot_id', null));
    }

    private static function stepOneSelectWorkAreaBlockPlot(): Forms\Components\Select
    {
        return Forms\Components\Select::make('work_area_block_plot_id')
            ->label('Petak')
            ->options(function (Forms\Get $get){
                return WorkAreaBlockPlot::whereWorkAreaBlockId($get('work_area_block_id'))
                    ->pluck('plot', 'id');
            })
            ->native(false);
    }

    private static function stepOneInputValueAmount(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('value_amount')
            ->label('Nilai Rantek')
            ->prefix('Rp')
            ->formatStateUsing(fn($state) => number_format($state, 0, ',', '.'))
            ->mask(RawJs::make(<<<'JS'
                $money($input, ',', '.', 0)
            JS))
            ->numeric()
            ->required()
            ->dehydrateStateUsing(fn(string $state) => str($state)->replace('.', '')->toInteger());
    }
}
