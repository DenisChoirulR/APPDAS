<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperWorkAreaBlockPlot
 */
class WorkAreaBlockPlot extends Model
{
    use HasUuids;

    protected $fillable = [
        'work_area_block_id',
        'planting_pattern_id',
        'plot',
        'plot_size',
    ];

    public function block(): BelongsTo
    {
        return $this->belongsTo(WorkAreaBlock::class, 'work_area_block_id');
    }

    public function pattern(): BelongsTo
    {
        return $this->belongsTo(PlantingPattern::class, 'planting_pattern_id');
    }
}
