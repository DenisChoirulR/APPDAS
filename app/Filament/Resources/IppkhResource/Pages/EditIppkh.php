<?php

namespace App\Filament\Resources\IppkhResource\Pages;

use App\Filament\Resources\IppkhResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIppkh extends EditRecord
{
    protected static string $resource = IppkhResource::class;

    protected static ?string $title = 'Ubah IPPKH';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
