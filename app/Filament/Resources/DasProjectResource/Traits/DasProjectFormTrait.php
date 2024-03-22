<?php

namespace App\Filament\Resources\DasProjectResource\Traits;

use App\Models\Company;
use App\Models\DasLocation;
use App\Models\DasProject;
use Filament\Forms;
trait DasProjectFormTrait
{
    use DasLocationFormTrait;

    protected static function dasProjectForm(): array
    {
        return [
            self::selectCompany(),
            self::selectLocation(),
            self::inputCode(),
            self::inputSkNumber(),
            self::inputDate(),
            self::inputAreaSize()
        ];
    }

    private static function selectCompany(): Forms\Components\Select
    {
        return Forms\Components\Select::make('company_id')
            ->label('Perusahaan')
            ->relationship('company', 'name')
            ->native(false)
            ->required()
            ->live();
    }

    private static function selectLocation(): Forms\Components\Select
    {
        return Forms\Components\Select::make('das_location_id')
            ->label('Lokasi')
            ->relationship('location', 'name')
            ->native(false)
            ->live()
            ->required()
            ->createOptionForm(self::dasLocationForm())
            ->editOptionForm(self::dasLocationForm());
    }

    private static function inputCode(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('code')
            ->label('Kode')
            ->autocomplete(false)
            ->nullable()
            ->placeholder('Masukan Kode')
            ->prefix(function (Forms\Get $get){
                $code = null;

                if($id = $get('company_id')){
                    $contractor = Company::find($id);
                    $code .= $contractor->code.'-';
                }

                if($id = $get('das_location_id')){
                    $contractor = DasLocation::find($id);
                    $code .= $contractor->name.'-';
                }

                return $code;
            })
            ->formatStateUsing(function (?DasProject $record, Forms\Get $get){
                $code = null;

                if($id = $get('company_id')){
                    $contractor = Company::find($id);
                    $code .= $contractor->code.'-';
                }

                if($id = $get('das_location_id')){
                    $contractor = DasLocation::find($id);
                    $code .= $contractor->name;
                }

                return str(str($record?->code)->remove($code))->replaceFirst('-', '');
            })
            ->dehydrateStateUsing(function (?string $state, Forms\Get $get){
                $code = null;

                if($id = $get('company_id')){
                    $contractor = Company::find($id);
                    $code .= $contractor->code.'-';
                }

                if($id = $get('das_location_id')){
                    $contractor = DasLocation::find($id);
                    $code .= $contractor->name.'-';
                }

                if($state){
                    $code .= $state;
                } else {
                    $code = str($code)->replaceEnd('-', '');
                }

                return $code;
            });
    }

    private static function inputSkNumber(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('sk_number')
            ->label('Nomor SK DAS')
            ->placeholder('Masukkan Nomor SK')
            ->autocomplete(false)
            ->required()
            ->string()
            ->maxLength(255);
    }

    private static function inputDate(): Forms\Components\DatePicker
    {
        return Forms\Components\DatePicker::make('issue_date')
            ->label('Tanggal')
            ->placeholder('Pilih Tanggal Terbit SK')
            ->required()
            ->native(false)
            ->date();
    }

    private static function inputAreaSize(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('area_size')
            ->label('Luas')
            ->placeholder('Masukkan Luas Area dalam Hektar')
            ->autocomplete(false)
            ->required()
            ->numeric()
            ->step('.01')
            ->suffix('Hektar');
    }
}
