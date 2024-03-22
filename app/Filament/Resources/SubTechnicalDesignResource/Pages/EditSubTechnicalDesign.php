<?php

namespace App\Filament\Resources\SubTechnicalDesignResource\Pages;

use App\Filament\Resources\SubTechnicalDesignResource;
use App\Filament\Resources\TechnicalDesignResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubTechnicalDesign extends EditRecord
{
    protected static string $resource = SubTechnicalDesignResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->successRedirectUrl(TechnicalDesignResource::getUrl('view', ['record' => $this->record->technical_design_id])),
        ];
    }
}
