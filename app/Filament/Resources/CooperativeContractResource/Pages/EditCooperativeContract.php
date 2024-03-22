<?php

namespace App\Filament\Resources\CooperativeContractResource\Pages;

use App\Filament\Resources\CooperativeContractResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCooperativeContract extends EditRecord
{
    protected static string $resource = CooperativeContractResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
