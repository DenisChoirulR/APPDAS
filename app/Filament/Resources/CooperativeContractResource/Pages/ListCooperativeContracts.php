<?php

namespace App\Filament\Resources\CooperativeContractResource\Pages;

use App\Filament\Resources\CooperativeContractResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCooperativeContracts extends ListRecords
{
    protected static string $resource = CooperativeContractResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
