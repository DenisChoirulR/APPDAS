<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperCompanyStatus
 */
class CompanyStatus extends Model
{
    use HasUuids;

    protected $fillable = [
        'status', 'description'
    ];

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }
}
