<?php

namespace App\Filament\Resources\DasProjectResource\Pages;

use App\Filament\Resources\DasProjectResource;
use Filament\Actions;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewDasProject extends ViewRecord
{
    protected static string $resource = DasProjectResource::class;

    protected static ?string $title = 'Detail SK DAS';

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
                        TextEntry::make('company.name')
                            ->label('Perusahaan'),
                        TextEntry::make('location.name')
                            ->label('Lokasi'),
                        TextEntry::make('code')
                            ->label('Kode'),
                        TextEntry::make('sk_number')
                            ->label('Nomor SK DAS'),
                        TextEntry::make('issue_date')
                            ->label('Tanggal')
                            ->date(),
                        TextEntry::make('area_size')
                            ->label('Luas')
                            ->suffix(' Hektar'),
                    ])->inlineLabel()
            ]);
    }
}
