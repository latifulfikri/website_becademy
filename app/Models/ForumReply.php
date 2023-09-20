<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ForumReply extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'account_id',
        'forum_id',
        'message'
    ];

    public function Account(): HasOne
    {
        return $this->hasOne(Account::class);
    }

    public function Forum(): HasOne
    {
        return $this->hasOne(Forum::class);
    }
}
