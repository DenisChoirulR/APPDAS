<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperWorkArea
 */
class WorkArea extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'das_project_id',
        'code'
    ];

    public function das_project(): BelongsTo
    {
        return $this->belongsTo(DasProject::class);
    }

    public function blocks(): HasMany
    {
        return $this->hasMany(WorkAreaBlock::class);
    }
}
