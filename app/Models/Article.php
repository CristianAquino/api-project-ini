<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    // uuid
    use HasUuids, HasFactory;

    protected $fillable = [
        'title',
        'content',
        'category_id',
    ];

    // relations
    // relation with comments
    function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    // relation with user
    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    // relation with category
    function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    // relation polimorphic with likes
    function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }
    // relation polimorphic with image
    function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    // relation polimorphic with notification
    function notifications(): MorphMany
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    // este metodo sirve para que cada vez
    // que creamos un articulo, el id del
    // usuario identificado sea settiado
    public static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (Auth::check()) {
                $article->user_id = Auth::id();
            }
        });
    }
}
