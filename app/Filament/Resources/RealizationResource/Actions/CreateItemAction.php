<?php

namespace App\Filament\Resources\RealizationResource\Actions;

use App\Models\Plant;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Actions\Action;
use MatanYadaev\EloquentSpatial\Objects\Point;

class CreateItemAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'create-item';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Catat Tanam');

        $this->form([
            Hidden::make('realization_id')->default($this->record->id),
            Select::make('plant_id')
                ->required()
                ->uuid()
                ->label('Tanaman')
                ->options(function (){
                    return Plant::whereSubTechnicalDesignId($this->record->work_order->sub_technical_design_id)
                        ->where('activity_category', $this->record->activity_category->name)
                        ->pluck('plant_name', 'id');
                })
                ->native(false),
            TextInput::make('latitude')
                ->required()
                ->numeric(),
            TextInput::make('longitude')
                ->required()
                ->numeric(),
            Select::make('planting_status')
                ->label('Status Tanam')
                ->required()
                ->options([
                    'Hidup' => 'Hidup',
                    'Mati' => 'Mati'
                ]),
            FileUpload::make('image')
                ->image()
                ->imageEditor()
        ]);

        $this->action(function (array $data){
            $this->record->items()->create([
                'realization_id' => $data['realization_id'],
                'plant_id' => $data['plant_id'],
                'location' => new Point($data['latitude'], $data['longitude']),
                'image' => $data['image'],
                'planting_status' => $data['planting_status']
            ]);
            $this->record->increment('realization_of_planting');

            $this->successNotificationTitle('Berhasil mencatat tanam, muat ulang halaman untuk melihat hasil.');
            $this->success();
        });
    }
}
