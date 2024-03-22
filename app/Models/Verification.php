<?php

namespace App\Models;

use App\Enums\VerificationStatusEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperVerification
 */
class Verification extends Model
{
    use HasUuids;

    protected $fillable = [
        'work_order_id',
        'realization_id',
        'percentage',
        'status',
        'document_file'
    ];

    protected $casts = [
        'status' => VerificationStatusEnum::class
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
