<?php

namespace App\Filament\Resources\TechnicalDesignResource\Traits;

use App\Models\DasProject;
use App\Models\WorkArea;
use Filament\Forms;
use Illuminate\Database\Eloquent\Builder;

trait TechnicalDesignFormTrait
{
    protected static function technicalDesignForm(): array
    {
        return [
            self::inputTitle(),
            self::selectCompany(),
            self::selectDas(),
            self::selectWorkArea(),
        ];
    }

    private static function inputTitle(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('title')
            ->label('Judul Rantek')
            ->required()
            ->string()
            ->maxLength(255)
            ->autocomplete(false);
    }

    private static function selectCompany(): Forms\Components\Select
    {
        return Forms\Components\Select::make('company_id')
                ->label('Perusahaan')
                ->relationship('company', 'name')
                ->native(false)
                ->live();
    }

    private static function selectDas(): Forms\Components\Select
    {
        return Forms\Components\Select::make('das_project_id')
                ->label('SK DAS')
                ->options(function (Forms\Get $get){
                    return DasProject::whereCompanyId($get('company_id'))->pluck('sk_number', 'id');
                })
                ->native(false)
                ->live();
    }

    private static function selectWorkArea(): Forms\Components\Select
    {
        return Forms\Components\Select::make('work_area_id')
                ->label('Area Kerja')
                ->options(function (Forms\Get $get){
                    return WorkArea::whereDasProjectId($get('das_project_id'))->pluck('code', 'id');
                })
                ->native(false);
    }
}
