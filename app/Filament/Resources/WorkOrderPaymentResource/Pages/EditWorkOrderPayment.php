<?php

namespace App\Filament\Resources\WorkOrderPaymentResource\Pages;

use App\Filament\Resources\WorkOrderPaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWorkOrderPayment extends EditRecord
{
    protected static string $resource = WorkOrderPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
