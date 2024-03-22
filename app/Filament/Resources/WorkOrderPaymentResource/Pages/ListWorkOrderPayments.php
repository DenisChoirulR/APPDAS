<?php

namespace App\Filament\Resources\WorkOrderPaymentResource\Pages;

use App\Filament\Resources\WorkOrderPaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkOrderPayments extends ListRecords
{
    protected static string $resource = WorkOrderPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
}
