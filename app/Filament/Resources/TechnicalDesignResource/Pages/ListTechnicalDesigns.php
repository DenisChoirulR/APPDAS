<?php

namespace App\Filament\Resources\TechnicalDesignResource\Pages;

use App\Filament\Resources\TechnicalDesignResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTechnicalDesigns extends ListRecords
{
    protected static string $resource = TechnicalDesignResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
