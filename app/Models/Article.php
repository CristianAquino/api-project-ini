<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    // uuid
    use HasUuids, HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];


    // relations
    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
