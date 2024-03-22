<?php

namespace App\Filament\Resources\WorkOrderResource\Actions;

use App\Enums\ActivityGroupEnum;
use App\Enums\VerificationStatusEnum;
use App\Models\Realization;
use App\Models\Verification;
use App\Models\WorkOrder;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Actions\Action;

class CreateVerification extends Action
{

    public static function getDefaultName(): ?string
    {
        return 'create-verification';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Buat Verifikasi');
        $this->modalWidth('sm');
        $this->color('warning');
        $this->visible(fn() => auth()->user()->can('create_verification'));

        $this->form([
            Hidden::make('work_order_id')
                ->default(fn($record) => $record?->id),
            Select::make('realization_id')
                ->required()
                ->uuid()
                ->label('Grup Aktivitas')
                ->options(function ($record){
                    return Realization::whereWorkOrderId($record->id)
                        ->get()
                        ->map(function ($data){
                            $planting_plan = $data->work_order->subTechnicalDesign
                                ->plants()
                                ->where('activity_category', ActivityGroupEnum::P0->name)
                                ->sum('number_of_plant');
                            $percent = 0;
                            if($planting_plan > 0 && $data->realization_of_planting > 0){
                                $percent = round(($data->realization_of_planting / $planting_plan) * 100, 2);
                            }

                            return [
                                'name' => $data->activity_category->getLabel() . ' - ' . $percent . '%',
                                'id' => $data->id
                            ];
                        })
                        ->pluck('name', 'id');
                })
                ->disableOptionWhen(function (string $value){
                    $realization = Realization::find($value);
                    $planting_plan = $realization->work_order->subTechnicalDesign
                        ->plants()
                        ->where('activity_category', ActivityGroupEnum::P0->name)
                        ->sum('number_of_plant');
                    $percent = 0;
                    if($planting_plan > 0 && $realization->realization_of_planting > 0){
                        $percent = round(($realization->realization_of_planting / $planting_plan) * 100, 2);
                    }
                    return $percent < 95 || $realization->status == VerificationStatusEnum::Passed;
                })
                ->native(false),
            TextInput::make('percentage')
                ->label('Persentase')
                ->required()
                ->numeric()
                ->maxValue(100)
                ->minValue(1)
                ->suffix('%'),
            FileUpload::make('document_file')
                ->required()
                ->acceptedFileTypes([
                    'application/pdf'
                ])
                ->label('Dokumen Berita Acara')
                ->helperText('Hanya mendukung file PDF')
                ->directory('verification')
        ]);

        $this->action(function (WorkOrder $record, array $data){
            $realization = Realization::find($data['realization_id']);
            $realization_count = $record->subTechnicalDesign
                    ->plants()
                    ->where('activity_category', ActivityGroupEnum::P0->name)
                    ->sum('number_of_plant') * ($data['percentage'] / 100);

            $status = VerificationStatusEnum::NotPass;

            if ($data['percentage'] >= $record->passing_standard){
                $status = VerificationStatusEnum::Passed;
            }

            $realization->update([
                'status' => $status,
                'realization_of_planting' => $realization_count
            ]);

            if($realization->activity_category == ActivityGroupEnum::P0){
                $next = $realization->work_order->realizations()
                    ->where('activity_category', ActivityGroupEnum::P1->name)
                    ->first();

                $next->update([
                    'realization_of_planting' => $realization_count
                ]);
            }

            if($realization->activity_category == ActivityGroupEnum::P1){
                $next = $realization->work_order->realizations()
                    ->where('activity_category', ActivityGroupEnum::P2->name)
                    ->first();

                $next->update([
                    'realization_of_planting' => $realization_count
                ]);
            }


            Verification::create([
                'work_order_id' => $record->id,
                'realization_id' => $data['realization_id'],
                'percentage' => $data['percentage'],
                'status' => $status,
                'document_file' => $data['document_file']
            ]);

            $this->successNotificationTitle('Data verifikasi berhasil disimpan');
            $this->success();
        });
    }

}
