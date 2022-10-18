<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'email',
        'email_verified_at',
        'password',
        'role_id',
        'status',
        'status_message',
        'status_date',
        'confirmation_token',
        'reset_token',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->morphOne(Profile::class, 'profileable');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, "user_id");
    }

    public function messages()
    {
        return $this->hasMany(Message::class, "user_id");
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function supports()
    {
        return $this->morphMany(Support::class, 'supportable');
    }


    public function scopeActive()
    {
        return $this->whereNotNull('emailed_verified_at');
    }

    public function hasPermission($permission)
    {
        if (is_array($permission)) {
            if (empty($permission = $this->role->permissions()->whereIn('name', $permission)->first())) {
                return false;
            }

            return $permission;
        }

        if (empty($permission = $this->role->permissions()->where('name', $permission)->first())) {
            return false;
        }

        return $permission;
    }

}
