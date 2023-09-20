<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tutor extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'account_id',
        'course_id'
    ];

    public function Account(): HasOne
    {
        return $this->hasOne(Account::class);
    }

    public function Course(): HasOne
    {
        return $this->hasOne(Course::class);
    }
}
