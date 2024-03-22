<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperSocial
 */
class Social extends Model
{
    use HasUuids;

    protected $fillable = [
        'sub_technical_design_id',
        'activity_category',
        'name_of_activity',
        'quantity'
    ];
}
