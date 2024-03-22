<?php

namespace App\Filament\Resources\RealizationResource\Pages;

use App\Filament\Resources\RealizationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRealizations extends ListRecords
{
    protected static string $resource = RealizationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
