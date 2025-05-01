<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // este metodo sirve para que cada vez
    // que creamos un comentario, el id del
    // usuario identificado sea setiado
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
