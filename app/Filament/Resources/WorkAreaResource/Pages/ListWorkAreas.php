<?php

namespace App\Filament\Resources\WorkAreaResource\Pages;

use App\Filament\Resources\WorkAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkAreas extends ListRecords
{
    protected static string $resource = WorkAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
