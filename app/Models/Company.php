<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @mixin IdeHelperCompany
 */
class Company extends Model implements HasMedia
{
    use HasUuids, SoftDeletes, InteractsWithMedia;
    protected $fillable = [
        'company_status_id',
        'code',
        'name',
        'address',
        'phone',
        'secondary_phone',
        'email',
        'deed_of_incorporation',
        'file_deed_of_incorporation',
        'company_status',
        'tax_identification_number',
    ];

    public function company_status(): BelongsTo
    {
        return $this->belongsTo(CompanyStatus::class);
    }

    public function deed_amendments(): HasMany
    {
        return $this->hasMany(DeedOfAmendment::class);
    }

    public function directors(): HasMany
    {
        return $this->hasMany(Director::class);
    }

    public function commissioners(): HasMany
    {
        return $this->hasMany(Commissioner::class);
    }

    public function share_percentages(): HasMany
    {
        return $this->hasMany(SharePercentage::class);
    }

    public function ippkh(): HasMany
    {
        return $this->hasMany(Ippkh::class);
    }
}
