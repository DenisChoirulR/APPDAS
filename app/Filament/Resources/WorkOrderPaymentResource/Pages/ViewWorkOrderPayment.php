<?php

namespace App\Filament\Resources\WorkOrderPaymentResource\Pages;

use App\Enums\PaymentStatusEnum;
use App\Enums\PaymentStepEnum;
use App\Enums\PaymentWorkStatusEnum;
use App\Enums\VerificationStatusEnum;
use App\Filament\Resources\WorkOrderPaymentResource;
use Filament\Actions;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewWorkOrderPayment extends ViewRecord
{
    protected static string $resource = WorkOrderPaymentResource::class;

    protected static ?string $title = 'Lihat Pembayaran';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->hidden(function ($record){
                    return $record->payment_status == PaymentStatusEnum::Paid &&
                        $record->work_status == PaymentWorkStatusEnum::Complete;
                }),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return parent::infolist($infolist)
            ->schema([
                Section::make()
                    ->schema([
                        TextEntry::make('workOrder.contract.contractor.company_name')
                            ->label('Kontraktor'),
                        TextEntry::make('workOrder.contract.contract_number')
                            ->label('Nomor Kontrak'),
                        TextEntry::make('workOrder.work_order_number')
                            ->label('Nomor SPK')
                    ]),
                Section::make()
                    ->schema([
                        Fieldset::make('Termin')
                            ->schema([
                                TextEntry::make('payment_step')
                                    ->label('Status'),
                                TextEntry::make('payment_date')
                                    ->date()
                                    ->label('Tanggal'),
                                TextEntry::make('nominal')
                                    ->date()
                                    ->prefix('Rp ')
                                    ->numeric(0, ',' ,'.'),
                            ])->columns(3),

                        Fieldset::make('Verifikasi')
                            ->schema([
                                TextEntry::make('verification_date')
                                    ->label('Tanggal')
                                    ->state(function ($record){
                                        if($record->realization){
                                            $verification = $record->realization
                                                ->verifications()
                                                ->where('status', VerificationStatusEnum::Passed->name)
                                                ->latest()
                                                ->first();

                                            if($verification){
                                                return $verification->created_at->format('d F Y');
                                            }
                                        }

                                        return '-';
                                    }),
                                TextEntry::make('verification_result')
                                    ->label('Hasil')
                                    ->state(function ($record){
                                        if($record->realization){
                                            $verification = $record->realization
                                                ->verifications()
                                                ->where('status', VerificationStatusEnum::Passed->name)
                                                ->latest()
                                                ->first();

                                            if($verification){
                                                return $verification->percentage . '%';
                                            }
                                        }

                                        return '-';
                                    }),
                                TextEntry::make('verification_status')
                                    ->label('Status')
                                    ->state(function ($record){
                                        if($record->realization){
                                            $verification = $record->realization
                                                ->verifications()
                                                ->where('status', VerificationStatusEnum::Passed->name)
                                                ->latest()
                                                ->first();

                                            if($verification){
                                                return $verification->status;
                                            }
                                        }

                                        return '-';
                                    }),
                            ])->columns(3),

                        Fieldset::make('Status')
                            ->schema([
                                TextEntry::make('payment_status')
                                    ->label('Pembayaran'),
                                TextEntry::make('work_status')
                                    ->label('Pekerjaan'),
                            ])->columns(3),
                    ])
            ])->inlineLabel();
    }
}
