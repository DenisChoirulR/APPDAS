<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperWorkAreaBlock
 */
class WorkAreaBlock extends Model
{
    use HasUuids;

    protected $fillable = [
        'work_area_id',
        'block_name',
        'block_size',
    ];

    public function work_area(): BelongsTo
    {
        return $this->belongsTo(WorkArea::class);
    }

    public function plots(): HasMany
    {
        return $this->hasMany(WorkAreaBlockPlot::class, 'work_area_block_id');
    }
}
