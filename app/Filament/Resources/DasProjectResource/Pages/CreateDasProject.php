<?php

namespace App\Filament\Resources\DasProjectResource\Pages;

use App\Filament\Resources\DasProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDasProject extends CreateRecord
{
    protected static string $resource = DasProjectResource::class;

    protected static ?string $title = 'Buat SK DAS';
}
