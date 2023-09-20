<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Material extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'module_id',
        'name',
        'video',
        'body'
    ];

    public function Module(): HasOne
    {
        return $this->hasOne(Module::class);
    }
}
