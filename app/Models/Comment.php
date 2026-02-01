<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'comment',
        'article_id',
        'parent_id'
    ];

    // relations
    // relation with user
    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    // relation with article
    function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
    // relation with comments
    // relation with parent
    function parent(): BelongsTo
    {
        // aca tomara el parent_id
        return $this->belongsTo(Comment::class);
    }
    // relation with children(replies)
    function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
    // relation polimorphic with likes
    function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }
    // relation polimorphic with notification
    function notifications(): MorphMany
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    // este metodo sirve para que cada vez
    // que creamos un comentario, el id del
    // usuario identificado sea settiado
    public static function boot()
    {
        parent::boot();

        static::creating(function ($comment) {
            if (Auth::check()) {
                $comment->user_id = Auth::id();
            }
        });
    }
}
