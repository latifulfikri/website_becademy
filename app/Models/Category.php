<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory, HasUuids, Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'color'
    ];

    public function Courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function Sluggable(): array {
        return [
            'slug'=> [
                'souce' => 'name'
            ],
        ];
    }
}
