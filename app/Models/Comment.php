<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'comment'
    ];
    // function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class);
    // }
    // function article(): BelongsTo
    // {
    //     return $this->belongsTo(Article::class);
    // }
}
