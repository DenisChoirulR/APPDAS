<?php

namespace App\Filament\Resources\DasProjectResource\Pages;

use App\Filament\Resources\DasProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDasProject extends EditRecord
{
    protected static string $resource = DasProjectResource::class;

    protected static ?string $title = 'Ubah SK DAS';

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
