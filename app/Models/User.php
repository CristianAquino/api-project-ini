<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'name',
        'email',
        'password',
        'role'
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
    function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
    function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    // roles
    const ROLE_SUPERADMIN = 'ROLE_SUPERADMIN';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_USER = 'ROLE_USER';

    private const ROLES_HIERARCHY = [
        self::ROLE_SUPERADMIN => [self::ROLE_ADMIN, self::ROLE_USER],
        self::ROLE_ADMIN => [self::ROLE_USER],
        self::ROLE_USER => [],
    ];

    public function isGranted($role)
    {
        return $role === $this->role || in_array($role, self::ROLES_HIERARCHY[$this->role]);
    }
}
