<?php

namespace App\Filament\Resources\WorkAreaResource\Traits;

use App\Models\DasProject;
use Filament\Forms;

trait WorkAreaFormTrait
{
    use WorkAreaBlockFormTrait;

    protected static function workAreaForm(): array
    {
        return [
            self::selectDas(),
            self::inputCode(),
            self::blockRelation(),
        ];
    }

    private static function selectDas(): Forms\Components\Select
    {
        return Forms\Components\Select::make('das_project_id')
            ->label('SK DAS')
            ->relationship('das_project','sk_number')
            ->searchable()
            ->required()
            ->afterStateUpdated(function (?string $state, Forms\Set $set){
                if(!is_null($state)){
                    $das = DasProject::find($state);
                    $set('code', $das->code);
                }
            })
            ->live();
    }

    private static function inputCode(): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make('code')
            ->label('Kode')
            ->required()
            ->string();
    }

    private static function blockRelation(): Forms\Components\Repeater
    {
        return Forms\Components\Repeater::make('blocks')
            ->required()
            ->label('Blok')
            ->visibleOn(['create'])
            ->relationship('blocks')
            ->schema(self::blockForm());
    }
}
