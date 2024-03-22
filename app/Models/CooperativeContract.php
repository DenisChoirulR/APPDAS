<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperCooperativeContract
 */
class CooperativeContract extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'company_id',
        'contractor_id',
        'contract_number',
        'contract_date',
        'document',
        'down_payment',
        'p0_payment',
        'p1_payment',
        'p2_payment',
        'security_deposit',
    ];

    protected $casts = [
        'contract_date' => 'date'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function contractor(): BelongsTo
    {
        return $this->belongsTo(Contractor::class, 'contractor_id');
    }

    public function workOrders(): HasMany
    {
        return $this->hasMany(WorkOrder::class, 'cooperative_contract_id');
    }
}
