<?php

namespace App\Models;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Application;
use MatanYadaev\EloquentSpatial\Objects\Point;

/**
 * @mixin IdeHelperRealizationItem
 */
class RealizationItem extends Model
{
    use HasUuids;

    protected $fillable = [
        'realization_id',
        'plant_id',
        'location',
        'image',
        'planting_status',
    ];

    protected $casts = [
        'location' => Point::class
    ];

    public function realization(): BelongsTo
    {
        return $this->belongsTo(Realization::class, 'realization_id');
    }

    public function plant(): BelongsTo
    {
        return $this->belongsTo(Plant::class, 'plant_id');
    }

    public function getImageUrlAttribute(): Application|string|UrlGenerator|\Illuminate\Contracts\Foundation\Application|null
    {
        return $this->image != null ? url("storage/{$this->image}") : null;
    }
}
