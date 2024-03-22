<?php

namespace App\Filament\Resources\IppkhResource\Traits;

use Filament\Forms;

trait IppkhFormTrait
{
    public static function formIppkh(): array
    {
        return [
            self::selectContractorId(),
            self::inputLicenseNumber(),
            self::inputIssueDate(),
            self::inputAreaSize()
        ];
    }

    private static function selectContractorId(): Forms\Components\Select
    {
        return Forms\Components\Select::make('company_id')
            ->label('Perusahaan')
            ->relationship('company', 'name')
            ->native(false)
            ->required()
            ->uuid();
    }

    private static function inputLicenseNumber(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('ippkh_license_number')
            ->label('SK. IPPHK')
            ->required()
            ->string();
    }

    private static function inputIssueDate(): Forms\Components\DatePicker
    {
        return Forms\Components\DatePicker::make('issue_date')
            ->label('Tanggal SK')
            ->native(false)
            ->required()
            ->date();
    }

    private static function inputAreaSize(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('area_size')
            ->label('Luas Area')
            ->suffix('Hektar')
            ->numeric()
            ->step('.01')
            ->required();
    }
}
