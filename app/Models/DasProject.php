<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperDasProject
 */
class DasProject extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'company_id',
        'das_location_id',
        'code',
        'sk_number',
        'issue_date',
        'area_size',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(DasLocation::class, 'das_location_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function ippkh(): BelongsToMany
    {
        return $this->belongsToMany(Ippkh::class, 'das_project_ippkh');
    }

    public function technicalDesigns(): HasMany
    {
        return $this->hasMany(TechnicalDesign::class);
    }
}
