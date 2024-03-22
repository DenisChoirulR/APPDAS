<?php

namespace App\Models;

use App\Enums\PaymentStatusEnum;
use App\Enums\PaymentStepEnum;
use App\Enums\PaymentWorkStatusEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkOrderPayment extends Model
{
    use HasUuids;

    protected $fillable = [
        'work_order_id',
        'realization_id',
        'payment_step',
        'nominal',
        'payment_date',
        'payment_status',
        'work_status',
        'file'
    ];

    protected $casts = [
        'payment_step' => PaymentStepEnum::class,
        'payment_status' => PaymentStatusEnum::class,
        'work_status' => PaymentWorkStatusEnum::class
    ];

    public function workOrder(): BelongsTo
    {
        return $this->belongsTo(WorkOrder::class);
    }

    public function realization(): BelongsTo
    {
        return $this->belongsTo(Realization::class);
    }
}
