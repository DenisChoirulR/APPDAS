<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperIppkh
 */
class Ippkh extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'company_id',
        'ippkh_license_number',
        'issue_date',
        'area_size',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function dasProjects(): BelongsToMany
    {
        return $this->belongsToMany(DasProject::class, 'das_project_ippkh');
    }
}
