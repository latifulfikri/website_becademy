<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
