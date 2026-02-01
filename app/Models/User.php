<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // implementacion de metodos para JWTAuth
    public function getJWTIdentifier()
    {
        return $this->getKey(); // ID del usuario
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    // Mutator para encriptar automáticamente la contraseña
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    // relations
    // relation with comments
    function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    // relation with role
    function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
    // relation with articles
    function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
    // relation with categories(many-to-many)
    function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
    // relation with likes
    function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }
    // usuarios a los que este usuario sigue
    function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'subscriptions', 'subscriber_id', 'author_id');
    }
    // usuarios que siguen a este usuario
    function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'subscriptions', 'author_id', 'subscriber_id');
    }
    // relation polimorphic with image
    function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    // relation with notifications
    public function sentNotifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'sender_id');
    }
    // relation with notifications
    public function receivedNotifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'recipient_id');
    }

    // roles
    // const ROLE_SUPERADMIN = 'ROLE_SUPERADMIN';
    // const ROLE_ADMIN = 'ROLE_ADMIN';
    // const ROLE_USER = 'ROLE_USER';

    // private const ROLES_HIERARCHY = [
    //     self::ROLE_SUPERADMIN => [self::ROLE_ADMIN, self::ROLE_USER],
    //     self::ROLE_ADMIN => [self::ROLE_USER],
    //     self::ROLE_USER => [],
    // ];

    // public function isGranted($role)
    // {
    //     return $role === $this->role || in_array($role, self::ROLES_HIERARCHY[$this->role]);
    // }
}
