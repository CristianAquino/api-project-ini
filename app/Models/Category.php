<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'category'
    ];

    // relations
    // relation with articles
    function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
    // relation with users(many-to-many)
    function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
