<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use App\Models\Company;
use Filament\Actions;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\FontWeight;

class ViewCompany extends ViewRecord
{
    protected static string $resource = CompanyResource::class;

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
                        TextEntry::make('name')
                            ->label('Nama Kontraktor'),
                        TextEntry::make('code')
                            ->label('Kode'),
                        TextEntry::make('address')
                            ->label('Alamat'),
                        TextEntry::make('phone')
                            ->label('Nomor Telepon'),
                        TextEntry::make('secondary_phone')
                            ->label('Telepon Alternatif')
                            ->default('-'),
                        TextEntry::make('tax_identification_number')
                            ->label('NPWP')
                            ->default('-'),
                        TextEntry::make('company_status.status')
                            ->label('Status Perusahaan'),

                        TextEntry::make('deed_of_incorporation')
                            ->label('Akta Pendirian')
                            ->default(fn(Company $record) => is_null($record->file_deed_of_incorporation) ? '-' : 'Unduh Dokumen')
                            ->url(function (Company $record){
                                if(!is_null($record->file_deed_of_incorporation)){
                                    return \Storage::url($record->file_deed_of_incorporation);
                                }

                                return null;
                            })
                            ->openUrlInNewTab()
                            ->weight(fn(Company $record) => is_null($record->file_deed_of_incorporation) ? '-' : FontWeight::Bold)
                            ->color(fn(Company $record) => is_null($record->file_deed_of_incorporation) ? '-' : Color::Green),

                        TextEntry::make('directors')
                            ->formatStateUsing(fn($state) => $state->position . ' - ' . $state->name)
                            ->label('Direktur')
                            ->listWithLineBreaks(),
                        TextEntry::make('commissioners')
                            ->formatStateUsing(fn($state) => $state->position . ' - ' . $state->name)
                            ->label('Komisaris')
                            ->listWithLineBreaks(),
                        TextEntry::make('share_percentages')
                            ->formatStateUsing(fn($state) => $state->name . ' - ' . $state->percentage)
                            ->label('Persentase Saham')
                            ->bulleted(),
                        TextEntry::make('deed_amendments.information')
                            ->label('Akta Perubahan Anggaran Dasar')
                            ->bulleted(),
                    ])
            ])->inlineLabel()->columns(1);
    }
}
