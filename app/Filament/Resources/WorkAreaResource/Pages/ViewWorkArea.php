<?php

namespace App\Filament\Resources\WorkAreaResource\Pages;

use App\Filament\Resources\WorkAreaResource;
use App\Models\WorkArea;
use Filament\Actions;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewWorkArea extends ViewRecord
{
    protected static string $resource = WorkAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return parent::infolist($infolist)
            ->schema([
                Section::make()
                    ->schema([
                        TextEntry::make('das_project.sk_number')
                            ->label('SK DAS'),
                        TextEntry::make('code')
                            ->label('Kode'),
                        TextEntry::make('blocks_count')
                            ->label('Jumlah Blok')
                            ->state(fn(WorkArea $record) => $record->blocks()->count().' Blok')
                    ])
            ])->inlineLabel();
    }
}
