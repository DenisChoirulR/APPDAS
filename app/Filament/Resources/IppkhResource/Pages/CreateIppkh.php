<?php

namespace App\Filament\Resources\IppkhResource\Pages;

use App\Filament\Resources\IppkhResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIppkh extends CreateRecord
{
    protected static string $resource = IppkhResource::class;

    protected static ?string $title = 'Buat IPPKH';
}
