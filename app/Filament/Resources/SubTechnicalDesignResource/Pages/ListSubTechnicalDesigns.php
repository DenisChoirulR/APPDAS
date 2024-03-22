<?php

namespace App\Filament\Resources\SubTechnicalDesignResource\Pages;

use App\Filament\Resources\SubTechnicalDesignResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubTechnicalDesigns extends ListRecords
{
    protected static string $resource = SubTechnicalDesignResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
