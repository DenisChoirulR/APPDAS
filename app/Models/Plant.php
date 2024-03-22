<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperPlant
 */
class Plant extends Model
{
    use HasUuids;

    protected $fillable = [
        'sub_technical_design_id',
        'plant_name',
        'activity_category',
        'number_of_plant',
        'price',
    ];
}
