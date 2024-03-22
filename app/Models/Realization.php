<?php

namespace App\Models;

use App\Enums\ActivityGroupEnum;
use App\Enums\VerificationStatusEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperRealization
 */
class Realization extends Model
{
    use HasUuids;

    protected $fillable = [
        'work_order_id',
        'activity_category',
        'realization_of_planting',
        'status'
    ];

    protected $casts = [
        'activity_category' => ActivityGroupEnum::class,
        'status' => VerificationStatusEnum::class
    ];

    public function work_order(): BelongsTo
    {
        return $this->belongsTo(WorkOrder::class, 'work_order_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(RealizationItem::class, 'realization_id');
    }

    public function verifications(): HasMany
    {
        return $this->hasMany(Verification::class);
    }
}
