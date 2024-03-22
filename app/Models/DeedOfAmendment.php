<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperDeedOfAmendment
 */
class DeedOfAmendment extends Model
{
    use HasUuids;

    protected $fillable = [
        'company_id',
        'information',
        'file'
    ];
}
