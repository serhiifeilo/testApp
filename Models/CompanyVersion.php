<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyVersion extends Model
{
    use HasFactory;

    protected $table = 'company_versions';

    public const UPDATED_AT = null;

    protected $fillable = [
        'company_id',
        'version',
        'snapshot',
    ];

    protected $casts = [
        'snapshot' => 'array',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}