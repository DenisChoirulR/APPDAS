<?php

namespace App\Filament\Resources\RealizationResource\Actions;

use App\Models\Plant;
use Closure;
use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;
use MatanYadaev\EloquentSpatial\Objects\Point;

class EditItemAction extends Action
{
    use CanCustomizeProcess;

    protected ?Closure $mutateRecordDataUsing = null;

    public static function getDefaultName(): ?string
    {
        return 'edit';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('filament-actions::edit.single.label'));

        $this->modalHeading(fn (): string => __('filament-actions::edit.single.modal.heading', ['label' => $this->getRecordTitle()]));

        $this->modalSubmitActionLabel(__('filament-actions::edit.single.modal.actions.save.label'));

        $this->successNotificationTitle(__('filament-actions::edit.single.notifications.saved.title'));

        $this->icon('heroicon-m-pencil-square');

        $this->form([
            Select::make('plant_id')
                ->required()
                ->uuid()
                ->label('Tanaman')
                ->options(function (){
                    return Plant::whereSubTechnicalDesignId($this->record->realization->work_order->sub_technical_design_id)
                        ->where('activity_category', $this->record->realization->activity_category->name)
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

        $this->fillForm(function (Model $record, Table $table): array {

            $data = [
                'plant_id' => $record->plant_id,
                'planting_status' => $record->planting_status,
                'image' => $record->image,
                'latitude' => $record->location->latitude,
                'longitude' => $record->location->longitude,
            ];

            return $data;
        });

        $this->action(function (): void {
            $this->process(function (array $data, Model $record) {
                $record->update([
                    'plant_id' => $data['plant_id'],
                    'location' => new Point($data['latitude'], $data['longitude']),
                    'image' => $data['image'],
                    'planting_status' => $data['planting_status']
                ]);
            });

            $this->success();
        });
    }

    public function mutateRecordDataUsing(?Closure $callback): static
    {
        $this->mutateRecordDataUsing = $callback;

        return $this;
    }
}
