<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Course extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'catagory_id',
        'name',
        'desc',
        'price',
        'min_processor',
        'min_storage',
        'min_ram',
        'is_active'
    ];

    public function Members(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    public function Tutors(): HasMany
    {
        return $this->hasMany(Tutor::class);
    }

    public function Modules(): HasMany
    {
        return $this->hasMany(Module::class);
    }

    public function Forums(): HasMany
    {
        return $this->hasMany(Forum::class);
    }

    public function Category(): HasOne
    {
        return $this->hasOne(Category::class);
    }
}
