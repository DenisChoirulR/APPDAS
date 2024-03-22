<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperPlantingPattern
 */
class PlantingPattern extends Model
{
    use HasUuids;

    protected $fillable = [
        'pattern'
    ];
}
