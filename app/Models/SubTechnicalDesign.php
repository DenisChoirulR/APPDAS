<?php

namespace App\Models;

use App\Enums\ActivityGroupEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperSubTechnicalDesign
 */
class SubTechnicalDesign extends Model
{
    use HasUuids;

    protected $fillable = [
        'technical_design_id',
        'work_area_block_id',
        'work_area_block_plot_id',
        'document_number',
        'value_amount'
    ];

    public function technical_design(): BelongsTo
    {
        return $this->belongsTo(TechnicalDesign::class, 'technical_design_id');
    }

    public function work_area_block(): BelongsTo
    {
        return $this->belongsTo(WorkAreaBlock::class, 'work_area_block_id');
    }

    public function work_area_block_plot(): BelongsTo
    {
        return $this->belongsTo(WorkAreaBlockPlot::class, 'work_area_block_plot_id');
    }

    public function plants(): HasMany
    {
        return $this->hasMany(Plant::class, 'sub_technical_design_id');
    }

    public function socials(): HasMany
    {
        return $this->hasMany(Social::class, 'sub_technical_design_id');
    }

    public function workOrders(): HasMany
    {
        return $this->hasMany(WorkOrder::class, 'sub_technical_design_id');
    }
}
