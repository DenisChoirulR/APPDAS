<?php

namespace App\Filament\Resources\WorkOrderResource\Traits;

use Filament\Forms;
use Filament\Support\RawJs;

trait WorkOrderFormTrait
{
    protected static function workOrderForm(): array
    {
        return [
            self::workOrderFormSelectContract(),
            self::workOrderFormSelectSubTechnicalDesign(),
            self::workOrderFormInputOrderNumber(),
            self::workOrderFormInputOrderDate(),
            self::workOrderFormInputOrderValue(),
            self::workOrderFormInputPassingStandard(),
            self::workOrderFormInputOrderDocument()
        ];
    }

    private static function workOrderFormSelectContract(): Forms\Components\Select
    {
        return Forms\Components\Select::make('cooperative_contract_id')
            ->label('Nomor Kontrak')
            ->placeholder('Pilih Nomor Kontrak')
            ->relationship('contract', 'contract_number')
            ->required()
            ->uuid()
            ->native(false);
    }

    private static function workOrderFormSelectSubTechnicalDesign(): Forms\Components\Select
    {
        return Forms\Components\Select::make('sub_technical_design_id')
            ->label('Dokumen Rantek')
            ->placeholder('Pilih Dokumen Rantek')
            ->relationship('subTechnicalDesign', 'document_number')
            ->required()
            ->uuid()
            ->native(false)
            ->disabledOn('edit');
    }

    private static function workOrderFormInputOrderNumber(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('work_order_number')
            ->label('Nomor SPK')
            ->placeholder('Masukan Nomor SPK')
            ->required()
            ->string();
    }

    private static function workOrderFormInputOrderDate(): Forms\Components\DatePicker
    {
        return Forms\Components\DatePicker::make('work_order_date')
            ->label('Tanggal SPK')
            ->placeholder('Pilih Tanggal SPK')
            ->required()
            ->date()
            ->native(false);
    }

    private static function workOrderFormInputOrderValue(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('work_order_value')
            ->label('Nilai SPK')
            ->placeholder('Masukan Nilai SPK')
            ->required()
            ->prefix('Rp')
            ->mask(RawJs::make(<<<'JS'
                $money($input, ',', '.', 0)
            JS))
            ->dehydrateStateUsing(function (string $state){
                return str($state)->remove('.')->toInteger();
            });
    }

    private static function workOrderFormInputOrderDocument(): Forms\Components\FileUpload
    {
        return Forms\Components\FileUpload::make('work_order_document')
            ->label('Dokumen SPK')
            ->placeholder('Unggah Dokumen SPK')
            ->visible()
            ->downloadable()
            ->required();
    }

    private static function workOrderFormInputPassingStandard(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('passing_standard')
            ->label('Standar Kelulusan')
            ->placeholder('Masukan nilai standar kelulusan (%)')
            ->required()
            ->suffix('%')
            ->numeric();
    }
}
