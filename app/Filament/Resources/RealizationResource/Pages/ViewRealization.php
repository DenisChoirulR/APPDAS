<?php

namespace App\Filament\Resources\RealizationResource\Pages;

use App\Exports\RealizationReport;
use App\Exports\WorkOrderReport;
use App\Filament\Resources\RealizationResource;
use App\Models\Realization;
use Filament\Actions;
use Filament\Forms\Get;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ViewRealization extends ViewRecord
{
    protected static string $resource = RealizationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            RealizationResource\Actions\CreateItemAction::make(),
            ExportAction::make()
                ->action(function ($record) {
                    return Excel::download(new RealizationReport($record), 'Realization Report.xlsx');
                })
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return parent::infolist($infolist)
            ->schema([
                Section::make()
                    ->schema([
                        TextEntry::make('activity_category')
                            ->label('Grup Aktivitas'),
                        TextEntry::make('planting_plan')
                            ->label('Rencana Tanam')
                            ->state(function (Realization $record){
                                return $record->work_order->subTechnicalDesign->plants()->sum('number_of_plant');
                            })
                            ->numeric(decimalPlaces: 0, decimalSeparator: ',', thousandsSeparator: '.'),
                        TextEntry::make('realization_of_planting')
                            ->label('Realisasi Tanam')
                            ->numeric(decimalPlaces: 0, decimalSeparator: ',', thousandsSeparator: '.'),
                        TextEntry::make('realization_percentage')
                            ->label('Persentase Realisasi')
                            ->state(function ($record){
                                $planting_plant = $record->work_order->subTechnicalDesign->plants()->sum('number_of_plant');
                                $realization_of_planting = $record->realization_of_planting;

                                return round(($realization_of_planting/$planting_plant) * 100, 2);
                            })
                            ->suffix('%'),
                        Fieldset::make('summary')
                            ->label('Ringkasan Realisasi')
                            ->schema($this->getPlants())
                            ->columns(1)
                    ]),
            ])->inlineLabel();
    }

    private function getPlants(): array
    {
        $plants = $this->record->work_order->subTechnicalDesign
            ->plants()
            ->where('activity_category', $this->record->activity_category->name)
            ->get();

        $result = [];
        foreach ($plants as $plant) {
            $result[] = TextEntry::make($plant->plant_name)
                    ->state(function () use ($plant){
                        $realization = $this->record->items()->where('plant_id', $plant->id)->count();
                        $number_of_plant = $plant->number_of_plant;
                        $percentage = ($realization/$number_of_plant) * 100;

                        return $realization.' ('.$percentage.'%)';
                    });
        }

        return $result;
    }
}
