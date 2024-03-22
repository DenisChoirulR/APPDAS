<?php

namespace App\Filament\Resources\WorkOrderResource\Actions;

use App\Enums\ActivityGroupEnum;
use App\Enums\PaymentStatusEnum;
use App\Enums\PaymentStepEnum;
use App\Enums\PaymentWorkStatusEnum;
use App\Enums\VerificationStatusEnum;
use App\Models\WorkOrder;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Filament\Support\Colors\Color;
use Filament\Support\RawJs;

class CreatePaymentAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'create-payment-action';
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->label('Buat Pembayaran');
        $this->color(Color::Sky);
        $this->visible(fn() => auth()->user()->can('create_work::order::payment'));

        $this->form([
            Hidden::make('realization_id')->nullable(),
            Select::make('payment_step')
                ->label('Jenis Pembayaran')
                ->options(PaymentStepEnum::class)
                ->required()
                ->native(false)
                ->disableOptionWhen(function (string $value, $record) {
                    $disabled = false;

                    $checkPaymentStep = function (string $step) use ($record) {
                        $realization = $record->realizations()->where('activity_category', $step)->first();
                        $paymentExists = $record->payments()->where('payment_step', $step)->exists();
                        $realizationNotPassed = $realization && $realization->status != VerificationStatusEnum::Passed;

                        return $paymentExists || $realizationNotPassed;
                    };

                    switch ($value) {
                        case PaymentStepEnum::DP->name:
                            $disabled = $record->payments()->where('payment_step', $value)->exists();
                            break;

                        case PaymentStepEnum::P0->name:
                            $disabled = $checkPaymentStep(ActivityGroupEnum::P0->name);
                            break;

                        case PaymentStepEnum::P1->name:
                            $disabled = $checkPaymentStep(ActivityGroupEnum::P1->name);
                            break;

                        case PaymentStepEnum::P2->name:
                            $disabled = $checkPaymentStep(ActivityGroupEnum::P2->name);
                            break;

                        case PaymentStepEnum::SD->name:
                            $exists = $record->payments()
                                ->where('payment_step', PaymentStepEnum::P2->name)
                                ->where('payment_status', PaymentStatusEnum::Paid->name)
                                ->exists();
                            $disabled = !$exists;
                            break;
                    }

                    return $disabled;
                })
                ->afterStateUpdated(function ($record, string $state, Set $set){
                    if ($state == PaymentStepEnum::P0->name) {
                        $realization = $record->realizations()
                            ->where('activity_category', ActivityGroupEnum::P0->name)
                            ->first();
                        if ($realization) {
                            $set('realization_id', $realization->id);
                        }
                    }
                })
                ->live(),
            TextInput::make('nominal')
                ->label('Nominal')
                ->required()
                ->prefix('Rp ')
                ->placeholder('Masukan Nominal Pembayaran')
                ->mask(RawJs::make(<<<'JS'
                    $money($input, ',', '.', 0)
                JS))
                ->dehydrateStateUsing(fn($state) => str($state)->remove('.')->toInteger()),
            Select::make('payment_status')
                ->label('Status Pembayaran')
                ->options(PaymentStatusEnum::class)
                ->required()
                ->native(false),
            Select::make('work_status')
                ->label('Status Pekerjaan')
                ->options(PaymentWorkStatusEnum::class)
                ->required()
                ->native(false),
            FileUpload::make('file')
                ->nullable()
                ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/webp', 'image/png', 'image/jpg'])
        ]);

        $this->action(function (WorkOrder $record, array $data){
            $record->payments()->create([
                'realization_id' => $data['realization_id'],
                'payment_step' => $data['payment_step'],
                'nominal' => $data['nominal'],
                'payment_status' => $data['payment_status'],
                'work_status' => $data['work_status'],
                'payment_date' => now()->toDateString()
            ]);
        });
    }
}
