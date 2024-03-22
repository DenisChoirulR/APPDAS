<?php

namespace App\Models;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Application;

/**
 * @mixin IdeHelperWorkOrder
 */
class WorkOrder extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'cooperative_contract_id',
        'sub_technical_design_id',
        'work_order_number',
        'work_order_date',
        'work_order_value',
        'work_order_document',
        'passing_standard'
    ];

    public function contract(): BelongsTo
    {
        return $this->belongsTo(CooperativeContract::class, 'cooperative_contract_id');
    }

    public function subTechnicalDesign(): BelongsTo
    {
        return $this->belongsTo(SubTechnicalDesign::class, 'sub_technical_design_id');
    }

    public function realizations(): HasMany
    {
        return $this->hasMany(Realization::class, 'work_order_id');
    }

    public function verifications(): HasMany
    {
        return $this->hasMany(Verification::class);
    }
    
    public function getWorkOrderDocumentUrlAttribute(): Application|string|UrlGenerator|\Illuminate\Contracts\Foundation\Application
    {
        return url("storage/{$this->work_order_document}");
    }

    public function payments(): HasMany
    {
        return $this->hasMany(WorkOrderPayment::class);
    }
}
