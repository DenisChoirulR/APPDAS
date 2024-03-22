<?php

namespace App\Filament\Resources\ContractorResource\Traits;

use Filament\Forms;

trait ContractorFormTrait
{
    protected static function contractorForm(): array
    {
        return [
            self::contractorFormInputCode(),
            self::contractorFormInputCompanyName(),
            self::contractorFormInputAddress(),
            self::contractorFormInputPhone(),
            self::contractorFormInputEmail(),
            self::contractorFormInputDeedOfIncorporation(),
            self::contractorFormInputCompanyRegistrationNumber(),
            self::contractorFormInputDirector(),
            self::contractorFormInputCompanyType(),
            self::contractorFormSelectCompanyStatus(),
            self::contractorFormInputWorkArea(),
            self::contractorFormInputTaxNumber(),
        ];
    }

    private static function contractorFormInputCode(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('code')
            ->placeholder('Masukan Kode Kontraktor')
            ->label('Kode')
            ->required()
            ->string()
            ->maxLength(10);
    }

    private static function contractorFormInputCompanyName(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('company_name')
            ->placeholder('Masukan Nama Kontraktor')
            ->label('Nama Kontraktor')
            ->required()
            ->string()
            ->maxLength(200);
    }

    private static function contractorFormInputAddress(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('address')
            ->placeholder('Masukan Alamat Kontraktor')
            ->label('Alamat')
            ->required()
            ->string()
            ->maxLength(255);
    }

    private static function contractorFormInputPhone(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('phone')
            ->placeholder('Masukan Telepon Kontraktor')
            ->label('Telepon')
            ->required()
            ->string()
            ->maxLength(100);
    }

    private static function contractorFormInputEmail(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('email')
            ->placeholder('Masukan Email Kontraktor')
            ->label('Email')
            ->required()
            ->email()
            ->maxLength(100);
    }

    private static function contractorFormInputDeedOfIncorporation(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('deed_of_incorporation')
            ->placeholder('Masukan Nomor Akta Pendirian')
            ->label('Akta Pendirian')
            ->required()
            ->string();
    }

    private static function contractorFormInputCompanyRegistrationNumber(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('company_registration_number')
            ->placeholder('Masukan NIB')
            ->label('NIB')
            ->required()
            ->string();
    }

    private static function contractorFormInputDirector(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('director')
            ->placeholder('Masukan Nama Direktur')
            ->label('Direktur')
            ->required()
            ->string();
    }

    private static function contractorFormInputCompanyType(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('company_type')
            ->placeholder('Masukan Tipe Perusahaan')
            ->label('Tipe Perusahaan')
            ->required()
            ->string();
    }

    private static function contractorFormSelectCompanyStatus()
    {
        return Forms\Components\Select::make('company_status_id')
            ->placeholder('Pilih Status Perusahaan')
            ->label('Status Perusahaan')
            ->required()
            ->relationship('companyStatus', 'status')
            ->native(false);
    }

    private static function contractorFormInputWorkArea(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('work_area')
            ->placeholder('Masukan Area Kerja')
            ->label('Area Kerja')
            ->required()
            ->string();
    }

    private static function contractorFormInputTaxNumber(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('tax_identification_number')
            ->placeholder('Masukan Nomor NPWP')
            ->label('NPWP')
            ->required()
            ->string();
    }
}
