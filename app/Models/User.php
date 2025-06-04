<?php

namespace App\Models;

use App\Enums\UserRole;
use App\Contracts\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Base\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    protected $fillable = [
        'name',
        'email',
        'role_id',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'password_confirmation' => 'hashed',
    ];

    public function is_admin(): bool
    {
        return $this->role_id === UserRole::Admin->value && $this->email_verified_at != null;
    }

    public function is_author(): bool
    {
        return $this->role_id === UserRole::Author->value && $this->email_verified_at != null;
    }

    public function is_guest(): bool
    {
        return $this->role_id === UserRole::Guest->value;
    }

    public function is_verified(): bool
    {
        return $this->email_verified_at != null;
    }

    public function role(): HasOne
    {
        return $this->hasOne(Role::class);
    }

    public function threads(): HasMany
    {
        return $this->hasMany(Thread::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
