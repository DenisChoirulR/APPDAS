<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperTechnicalDesign
 */
class TechnicalDesign extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'company_id',
        'das_project_id',
        'work_area_id',
        'title',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function das_project(): BelongsTo
    {
        return $this->belongsTo(DasProject::class, 'das_project_id');
    }

    public function work_area(): BelongsTo
    {
        return $this->belongsTo(WorkArea::class, 'work_area_id');
    }

    public function blocks(): HasManyThrough
    {
        return $this->hasManyThrough(WorkAreaBlock::class, WorkArea::class);
    }

    public function subTechnicalDesign(): HasMany
    {
        return $this->hasMany(SubTechnicalDesign::class, 'technical_design_id');
    }
}
