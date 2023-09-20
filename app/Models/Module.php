<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Module extends Model
{
    use HasFactory,HasUuids;

    protected $fillable = [
        'course_id',
        'name'
    ];

    public function Materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }

    public function Course(): HasOne
    {
        return $this->hasOne(Course::class);
    }
}
