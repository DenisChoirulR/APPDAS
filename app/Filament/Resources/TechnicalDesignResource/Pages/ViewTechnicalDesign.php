<?php

namespace App\Filament\Resources\TechnicalDesignResource\Pages;

use App\Filament\Resources\TechnicalDesignResource;
use Filament\Actions;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewTechnicalDesign extends ViewRecord
{
    protected static string $resource = TechnicalDesignResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return parent::infolist($infolist)
            ->schema([
                Section::make()
                    ->schema([
                        TextEntry::make('title')->label('Judul'),
                        TextEntry::make('company.name')->label('Perusahaan'),
                        TextEntry::make('das_project.sk_number')->label('SK DAS'),
                        TextEntry::make('work_area.code')->label('Area Kerja'),
                    ])
            ])->inlineLabel()->columns(1);
    }
}
