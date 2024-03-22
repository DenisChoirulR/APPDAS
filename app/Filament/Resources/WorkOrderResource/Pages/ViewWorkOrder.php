<?php

namespace App\Filament\Resources\WorkOrderResource\Pages;

use App\Filament\Resources\WorkOrderResource;
use Filament\Actions;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewWorkOrder extends ViewRecord
{
    protected static string $resource = WorkOrderResource::class;

    public function getTitle(): string|Htmlable
    {
        return 'Perintah Kerja (SPK) - #' . $this->record->work_order_number;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            WorkOrderResource\Actions\CreateVerification::make(),
            WorkOrderResource\Actions\CreatePaymentAction::make()
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return parent::infolist($infolist)
            ->schema([
                Grid::make()
                    ->schema([
                        Section::make('General Info')
                            ->schema([
                                TextEntry::make('contract.contract_number')
                                    ->label('Nomor Kontrak'),
                                TextEntry::make('subTechnicalDesign.document_number')
                                    ->label('Dokumen Rantek'),
                                TextEntry::make('work_order_number')
                                    ->label('Nomor SPK'),
                                TextEntry::make('work_order_date')
                                    ->label('Tanggal SPK')
                                    ->date(),
                                TextEntry::make('work_order_value')
                                    ->label('Nilai SPK')
                                    ->prefix('Rp ')
                                    ->numeric(0, ',', '.'),
                                TextEntry::make('passing_standard')
                                    ->label('Standar Kelulusan')
                                    ->suffix('%'),
                            ])
                            ->columnSpan(1),
                        Section::make('Pembayaran')
                            ->relationship('contract')
                            ->schema([
                                TextEntry::make('down_payment')
                                    ->label('Down Payment')
                                    ->formatStateUsing(function ($record){
                                        $nominal = $record->work_order_value * ($record->contract->down_payment / 100);
                                        $nominal = number_format($nominal, 0, ',', '.');
                                        $nominal .= " ({$record->contract->down_payment}%)";
                                        return $nominal;
                                    })
                                    ->prefix('Rp '),
                                TextEntry::make('p0_payment')
                                    ->label('P0 / Termin 1')
                                    ->formatStateUsing(function ($record){
                                        $nominal = $record->work_order_value * ($record->contract->p0_payment / 100);
                                        $nominal = number_format($nominal, 0, ',', '.');
                                        $nominal .= " ({$record->contract->p0_payment}%)";
                                        return $nominal;
                                    })
                                    ->prefix('Rp '),
                                TextEntry::make('p1_payment')
                                    ->label('P1 / Termin 2')
                                    ->formatStateUsing(function ($record){
                                        $nominal = $record->work_order_value * ($record->contract->p1_payment / 100);
                                        $nominal = number_format($nominal, 0, ',', '.');
                                        $nominal .= " ({$record->contract->p1_payment}%)";
                                        return $nominal;
                                    })
                                    ->prefix('Rp '),
                                TextEntry::make('p2_payment')
                                    ->label('P2 / Termin 3')
                                    ->formatStateUsing(function ($record){
                                        $nominal = $record->work_order_value * ($record->contract->p2_payment / 100);
                                        $nominal = number_format($nominal, 0, ',', '.');
                                        $nominal .= " ({$record->contract->p2_payment}%)";
                                        return $nominal;
                                    })
                                    ->prefix('Rp '),
                                TextEntry::make('security_deposit')
                                    ->label('Jaminan')
                                    ->formatStateUsing(function ($record){
                                        $nominal = $record->work_order_value * ($record->contract->security_deposit / 100);
                                        $nominal = number_format($nominal, 0, ',', '.');
                                        $nominal .= " ({$record->contract->security_deposit}%)";
                                        return $nominal;
                                    })
                                    ->prefix('Rp ')
                            ])
                            ->columns(1)
                            ->columnSpan(1)
                    ])
            ])
            ->columns(1)
            ->inlineLabel();
    }
}
