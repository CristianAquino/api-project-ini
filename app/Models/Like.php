<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Auth;

class Like extends Model
{
    //
    use HasFactory;

    // relacions
    // relation with user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    // relation polimorphic
    public function likeable(): MorphTo
    {
        return $this->morphTo();
    }
    // relation polimorphic with notification
    function notifications(): MorphMany
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    // este metodo sirve para que cada vez
    // que damos un like, el id del
    // usuario identificado sea settiado
    public static function boot()
    {
        parent::boot();

        static::creating(function ($like) {
            if (Auth::check()) {
                $like->user_id = Auth::id();
            }
        });
    }
}
