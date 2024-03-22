<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperContractor
 */
class Contractor extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'company_status_id',
        'code',
        'company_name',
        'address',
        'phone',
        'email',
        'deed_of_incorporation',
        'file_deed_of_incorporation',
        'company_registration_number',
        'file_company_registration_number',
        'director',
        'company_type',
        'work_area',
        'tax_identification_number',
    ];

    public function companyStatus(): BelongsTo
    {
        return $this->belongsTo(CompanyStatus::class, 'company_status_id');
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(CooperativeContract::class, 'contractor_id');
    }
}
