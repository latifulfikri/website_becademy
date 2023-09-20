<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Forum extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'account_id',
        'course_id',
        'message'
    ];

    public function ForumReplies(): HasMany
    {
        return $this->hasMany(ForumReply::class);
    }

    public function Account(): HasOne
    {
        return $this->hasOne(Account::class);
    }

    public function Course(): HasOne
    {
        return $this->hasOne(Course::class);
    }
}
