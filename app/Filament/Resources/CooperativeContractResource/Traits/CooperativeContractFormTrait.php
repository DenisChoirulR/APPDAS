<?php

namespace App\Filament\Resources\CooperativeContractResource\Traits;

use Filament\Forms;

function calculatePercent(Forms\Get $get, Forms\Set $set)
{
    $down_payment = $get('down_payment') ?: 0;
    $p0_payment = $get('p0_payment') ?: 0;
    $p1_payment = $get('p1_payment') ?: 0;
    $p2_payment = $get('p2_payment') ?: 0;
    $security_deposit = $get('security_deposit') ?: 0;
    $total = $down_payment + $p0_payment + $p1_payment + $p2_payment + $security_deposit;

    $set('total_percent', $total);
}

trait CooperativeContractFormTrait
{
    protected static function cooperativeContractForm(): array
    {
        return [
            self::cooperativeContractFormSelectCompany(),
            self::cooperativeContractFormSelectContractor(),
            self::cooperativeContractFormInputContractNumber(),
            self::cooperativeContractFormInputContractDate(),
            self::cooperativeContractFormInputDocument(),
            Forms\Components\Fieldset::make('Aturan Pembayaran')
                ->schema([
                    self::downPaymentInput(),
                    self::p0PaymentInput(),
                    self::p1PaymentInput(),
                    self::p2PaymentInput(),
                    self::securityDepositInput(),
                    Forms\Components\TextInput::make('total_percent')
                        ->label('Total Persentase')
                        ->disabled()
                        ->suffix('%')
                ])
                ->inlineLabel()->columns(1),
        ];
    }

    private static function cooperativeContractFormSelectCompany(): Forms\Components\Select
    {
        return Forms\Components\Select::make('company_id')
            ->label('Perusahaan')
            ->placeholder('Pilih Perusahaan')
            ->relationship('company', 'name')
            ->required()
            ->uuid()
            ->native(false);
    }

    private static function cooperativeContractFormSelectContractor(): Forms\Components\Select
    {
        return Forms\Components\Select::make('contractor_id')
            ->label('Kontraktor')
            ->placeholder('Pilih Kontraktor')
            ->relationship('contractor', 'company_name')
            ->required()
            ->uuid()
            ->native(false);
    }

    private static function cooperativeContractFormInputContractNumber(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('contract_number')
            ->label('Nomor Kontrak')
            ->placeholder('Masukan Nomor Kontrak')
            ->required()
            ->string();
    }

    private static function cooperativeContractFormInputContractDate(): Forms\Components\DatePicker
    {
        return Forms\Components\DatePicker::make('contract_date')
            ->label('Tanggal Kontrak')
            ->placeholder('Pilih Tanggal Kontak')
            ->required()
            ->date()
            ->native(false);
    }

    private static function cooperativeContractFormInputDocument(): Forms\Components\FileUpload
    {
        return Forms\Components\FileUpload::make('document')
            ->label('Dokumen Kontrak')
            ->downloadable()
            ->openable()
            ->required();
    }

    private static function downPaymentInput(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('down_payment')
            ->label('Down Payment')
            ->numeric()
            ->maxValue(100)
            ->minValue(1)
            ->suffix('%')
            ->required()
            ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set){
                calculatePercent($get, $set);
            })
            ->live();
    }

    private static function p0PaymentInput(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('p0_payment')
            ->label('P0 / Termin 1')
            ->numeric()
            ->maxValue(100)
            ->minValue(1)
            ->suffix('%')
            ->required()
            ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set){
                calculatePercent($get, $set);
            })
            ->live();
    }

    private static function p1PaymentInput(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('p1_payment')
            ->label('P1 / Termin 2')
            ->numeric()
            ->maxValue(100)
            ->minValue(1)
            ->suffix('%')
            ->required()
            ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set){
                calculatePercent($get, $set);
            })
            ->live();
    }

    private static function p2PaymentInput(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('p2_payment')
            ->label('P2 / Termin 3')
            ->numeric()
            ->maxValue(100)
            ->minValue(1)
            ->suffix('%')
            ->required()
            ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set){
                calculatePercent($get, $set);
            })
            ->live();
    }

    private static function securityDepositInput(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('security_deposit')
            ->label('Jaminan')
            ->numeric()
            ->maxValue(100)
            ->minValue(1)
            ->suffix('%')
            ->required()
            ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set){
                calculatePercent($get, $set);
            })
            ->live();
    }
}
