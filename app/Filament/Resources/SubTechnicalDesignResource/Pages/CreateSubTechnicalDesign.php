<?php

namespace App\Filament\Resources\SubTechnicalDesignResource\Pages;

use App\Filament\Resources\SubTechnicalDesignResource;
use App\Filament\Resources\TechnicalDesignResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateSubTechnicalDesign extends CreateRecord
{
    protected static string $resource = SubTechnicalDesignResource::class;

    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return TechnicalDesignResource::getUrl('view', ['record' => $this->getRecord()->technical_design_id]);
    }
}
