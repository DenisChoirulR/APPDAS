<?php

namespace App\Filament\Resources\IppkhResource\Pages;

use App\Filament\Resources\IppkhResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIppkhs extends ListRecords
{
    protected static string $resource = IppkhResource::class;

    protected static ?string $title = 'IPPKH';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
