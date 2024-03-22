<?php

namespace App\Filament\Resources\VerificationResource\Pages;

use App\Filament\Resources\VerificationResource;
use Filament\Actions;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\FontWeight;

class ViewVerification extends ViewRecord
{
    protected static string $resource = VerificationResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return parent::infolist($infolist)
            ->schema([
                Section::make()
                    ->schema([
                        TextEntry::make('workOrder.work_order_number')
                            ->label('Nomor SPK'),

                        TextEntry::make('realization.activity_category')
                            ->label('Grup Aktifitas'),

                        TextEntry::make('percentage')
                            ->label('Persentase')
                            ->suffix('%'),

                        TextEntry::make('status'),

                        TextEntry::make('document_file')
                            ->label('Berita Acara')
                            ->url(fn($state) => asset('storage/'.$state), true)
                            ->formatStateUsing(fn() => 'Buka Berkas')
                            ->weight(FontWeight::Bold)
                            ->color('primary')
                    ])->inlineLabel()->columns(1)
            ]);
    }
}
