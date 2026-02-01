<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Notification extends Model
{
    //
    use HasFactory;

    public $protected = [
        'type',
        'recipient_id',
        'sender_id',
    ];

    // relations
    // relation polimorphic
    function notificable(): MorphTo
    {
        return $this->morphTo();
    }
    // usuario que recibe la notificacion
    function recipient(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    // usuario que genera la notificacion
    function sender(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
