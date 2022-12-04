<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class Administrator extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'email',
        'password',
        'reset_token',
    ];

    public function profile()
    {
        return $this->morphOne(Profile::class, 'profileable');
    }

    public function messages()
    {
        return $this->hasMany(Support_message::class, "admin_id");
    }

    public function role()
    {
        return $this->belongsTo(Admin_role::class, 'role_id');
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

    public function isSuperAdmin()
    {
        if ($this->role->name == "super") {
            return true;
        }
        return false;
    }

}
