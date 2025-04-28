<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'comment',
    ];


    // relations
    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    // este metodo sirve para que cada vez
    // que creamos un comentario, el id del
    // usuario identificado sea setiado
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
