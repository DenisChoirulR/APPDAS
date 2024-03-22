<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperSharePercentage
 */
class SharePercentage extends Model
{
    use HasUuids;

    protected $fillable = [
        'company_id',
        'name',
        'percentage',
    ];
}
