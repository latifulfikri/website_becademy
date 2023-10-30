<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Module extends Model
{
    use HasFactory,HasUuids, Sluggable;

    protected $fillable = [
        'course_id',
        'name',
        'slug'
    ];

    public function Materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }

    public function Course(): HasOne
    {
        return $this->hasOne(Course::class,'id','course_id');
    }

    public function Sluggable(): array {
        return [
            'slug'=> [
                'source' => 'name'
            ],
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($modul) {
            $modul->slug = SlugService::createSlug($modul, 'slug', $modul->name);
        });
    }
}
