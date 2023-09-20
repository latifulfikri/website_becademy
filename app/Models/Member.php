<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Member extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'account_id',
        'course_id',
        'payment_method',
        'payment_picture',
        'payment_verified'
    ];

    protected $hidden = [
        'payment_method',
        'payment_picture'
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
