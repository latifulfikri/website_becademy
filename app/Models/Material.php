<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Material extends Model
{
    use HasFactory, HasUuids, Sluggable;

    protected $fillable = [
        'module_id',
        'name',
        'slug',
        'video',
        'body'
    ];

    public function Module(): HasOne
    {
        return $this->hasOne(Module::class,'id','module_id');
    }

    public function Sluggable(): array {
        return [
            'slug'=> [
                'souce' => 'name'
            ],
        ];
    }
}
