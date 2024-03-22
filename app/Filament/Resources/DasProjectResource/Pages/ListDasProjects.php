<?php

namespace App\Filament\Resources\DasProjectResource\Pages;

use App\Filament\Resources\DasProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDasProjects extends ListRecords
{
    protected static string $resource = DasProjectResource::class;

    protected static ?string $title = 'SK DAS';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
