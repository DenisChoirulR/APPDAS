<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperDasLocation
 */
class DasLocation extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'name'
    ];
}
