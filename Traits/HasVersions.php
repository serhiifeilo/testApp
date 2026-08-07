<?php

namespace App\Traits;

use App\Models\CompanyVersion;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasVersions
{
    public function versions(): HasMany
    {
        return $this->hasMany(
            CompanyVersion::class
        )->orderBy('version');
    }

    public function latestVersion(): ?CompanyVersion
    {
        return $this->versions()
            ->latest('version')
            ->first();
    }
}