<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
        'payment_picture'
    ];

    protected function paymentVerified(): Attribute
    {
        return new Attribute(
            get: fn($value) => ["Process","Success","Fail"][$value]
        );
    }

    public function Account(): HasOne
    {
        return $this->hasOne(Account::class,'id','account_id');
    }

    public function Course(): HasOne
    {
        return $this->hasOne(Course::class,'id','course_id');
    }
}
