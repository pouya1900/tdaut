<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use phpDocumentor\Reflection\Types\True_;

class Member extends Authenticatable
{
    use HasFactory;

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
        'rank_id',
        'department_id',
        'group',
        'degree_id',
        'student_number',
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

    public function degree()
    {
        return $this->belongsTo(Degree::class, "degree_id");
    }

    public function department()
    {
        return $this->belongsTo(Department::class, "department_id");
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class, 'rank_id');
    }

    public function offices()
    {
        if ($this->pivot && $role_id = $this->pivot->role_id) {
            return $this->belongsToMany(Office::class, 'office_member')->where('role_id', $role_id);
        }

        return $this->belongsToMany(Office::class, 'office_member');
    }

    public function roles()
    {
        if ($this->pivot && $office_id = $this->pivot->office_id) {
            return $this->belongsToMany(Office_role::class, 'office_member', 'member_id', 'role_id')->where('office_id', $office_id);
        }
        return $this->belongsToMany(Office_role::class, 'office_member', 'member_id', 'role_id');
    }

    public function scopeActive()
    {
        return $this->whereNotNull('emailed_verified_at');
    }

    public function hasPermission($permission, $office_id)
    {
        foreach ($this->roles as $role) {

            if (is_array($permission)) {
                if ($permission = $role->permissions()->whereIn('name', $permission)->where('office_id', $office_id)->first()) {
                    return $permission;
                }
            } else {
                if ($permission = $role->permissions()->where('name', $permission)->where('office_id', $office_id)->first()) {
                    return $permission;
                }
            }

        }

        return false;
    }

    public function isSuperAdmin($office_id)
    {
        foreach ($this->roles as $role) {
            if ($role->permissions()->where('name', '*')->where('office_id', $office_id)->first()) {
                return true;
            }
        }
        return false;
    }


}
