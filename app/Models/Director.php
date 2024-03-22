<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperDirector
 */
class Director extends Model
{
    use HasUuids;

    protected $fillable = [
        'company_id',
        'name',
        'position',
    ];
}
