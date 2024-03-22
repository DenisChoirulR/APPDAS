<?php

namespace App\Filament\Resources\CompanyResource\Traits;

use Filament\Forms;
trait CompanyFormTrait
{
    use CompanyStatusFormTrait;

    protected static function contractorForm(): array
    {
        return [
            self::inputName(),
            self::inputCode(),
            self::inputAddress(),
            self::inputPhone(),
            self::inputSecondaryPhone(),
            self::inputTaxNumber(),
            self::selectCompanyStatus(),
            self::directors(),
            self::commissioners(),
            self::share_percentages(),
            self::deeds(),
        ];
    }

    private static function inputName(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('name')
            ->label('Nama Perusahaan')
            ->placeholder('Masukkan Nama Perusahaan')
            ->required()
            ->string()
            ->autocomplete(false)
            ->maxLength(255);
    }

    private static function inputCode(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('code')
            ->label('Kode')
            ->placeholder('Masukkan Kode Perusahaan')
            ->required()
            ->string()
            ->maxLength(10);
    }

    private static function inputAddress(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('address')
            ->label('Alamat Perusahaan')
            ->placeholder('Masukkan Alamat Lengkap Perusahaan')
            ->required()
            ->string()
            ->maxLength(255);
    }

    private static function inputPhone(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('phone')
            ->label('Nomor Telepon')
            ->placeholder('Masukkan Nomor Telepon Utama')
            ->required();
    }

    private static function inputSecondaryPhone(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('secondary_phone')
            ->label('Telepon Alternatif')
            ->placeholder('Masukkan Nomor Telepon Alternatif (Opsional)')
            ->nullable()
            ->string();
    }

    private static function inputTaxNumber(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('tax_identification_number')
            ->label('NPWP')
            ->placeholder('Masukkan Nomor NPWP Perusahaan')
            ->mask('99.999.999.9-999.999')
            ->required()
            ->string();
    }

    private static function selectCompanyStatus(): Forms\Components\Select
    {
        return Forms\Components\Select::make('company_status_id')
            ->label('Status Perusahaan')
            ->placeholder('Pilih Status Perusahaan')
            ->relationship('company_status', 'status')
            ->native(false)
            ->editOptionForm(self::companyStatusForm())
            ->createOptionForm(self::companyStatusForm())
            ->createOptionModalHeading('Buat Status Baru')
            ->editOptionModalHeading('Ubah Status');
    }

    private static function deeds(): Forms\Components\Fieldset
    {
        return Forms\Components\Fieldset::make('Akta Perusahaan')
            ->schema([
                Forms\Components\TextInput::make('deed_of_incorporation')
                    ->label('Akta Pendirian')
                    ->nullable()
                    ->string()
                    ->placeholder('Masukkan Nomor Akta Pendirian Perusahaan'),
                Forms\Components\FileUpload::make('file_deed_of_incorporation')
                    ->label('Dokumen Akta Pendirian')
                    ->openable()
                    ->downloadable()
                    ->directory('deed_of_incorporation')
                    ->nullable()
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\Repeater::make('deed_of_amendments')
                    ->label('Akta Perubahan Anggaran Dasar')
                    ->relationship('deed_amendments')
                    ->defaultItems(0)
                    ->schema([
                        Forms\Components\TextInput::make('information')
                            ->label('Keterangan')
                            ->required()
                            ->string()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('file')
                            ->label('Dokumen')
                            ->openable()
                            ->downloadable()
                            ->directory('deed_of_amendment')
                            ->nullable()
                            ->acceptedFileTypes(['application/pdf']),
                    ])
            ])->columns(1);
    }

    private static function directors(): Forms\Components\Repeater
    {
        return Forms\Components\Repeater::make('directors')
            ->label('Direktur')
            ->relationship('directors')
            ->minItems(1)
            ->deletable(fn($state) => count($state) > 1)
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama')
                    ->placeholder('Masukan nama direktur')
                    ->required()
                    ->string()
                    ->maxLength(255),
                Forms\Components\TextInput::make('position')
                    ->label('Posisi / Jabatan')
                    ->nullable()
                    ->placeholder('Contoh : Direktur Utama')
                    ->string()
                    ->maxLength(255)
                    ->required(),
            ]);
    }

    private static function commissioners(): Forms\Components\Repeater
    {
        return Forms\Components\Repeater::make('commissioners')
            ->label('Komisaris')
            ->relationship('commissioners')
            ->defaultItems(0)
            ->maxItems(3)
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama')
                    ->placeholder('Masukan nama komisaris')
                    ->required()
                    ->string()
                    ->maxLength(255),
                Forms\Components\TextInput::make('position')
                    ->label('Posisi / Jabatan')
                    ->nullable()
                    ->placeholder('Contoh : Komisaris Utama')
                    ->string()
                    ->maxLength(255)
                    ->required(),
            ]);
    }

    private static function share_percentages(): Forms\Components\Repeater
    {
        return Forms\Components\Repeater::make('share_percentages')
            ->label('Persentase Saham')
            ->relationship('share_percentages')
            ->defaultItems(0)
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama')
                    ->placeholder('Masukan nama pemengang saham')
                    ->required()
                    ->string()
                    ->maxLength(255),
                Forms\Components\TextInput::make('percentage')
                    ->label('Persentase Saham')
                    ->nullable()
                    ->placeholder('Contoh : 20.000 Saham atau 50%')
                    ->string()
                    ->maxLength(255)
                    ->required(),
            ]);
    }
}
