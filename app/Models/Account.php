<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Schema;

class Account extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use HasFactory, HasUuids, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'picture',
        'gender',
        'school',
        'degree',
        'field_of_study',
        'title',
        'company',
        'location',
        'withdraw_method',
        'withdraw_number'
    ];

    protected $hidden = [
        'password',
        'withdraw_method',
        'withdraw_number',
        'remember_token',
        'role',
    ];

    protected function role(): Attribute
    {
        return new Attribute(
            get: fn($value) => ["member","admin"][$value]
        );
    }

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
