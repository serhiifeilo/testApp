<?php

namespace App\Models;

use App\Contracts\Versionable;
use App\Traits\HasVersions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model implements Versionable
{
    use HasFactory;
    use HasVersions;

    protected $fillable = [
        'name',
        'edrpou',
        'address',
    ];

    public function getVersionSnapshot(): array
    {
        return [
            'name' => $this->name,
            'edrpou' => $this->edrpou,
            'address' => $this->address,
        ];
    }

    public function getVersionableId(): int
    {
        return $this->getKey();
    }
}