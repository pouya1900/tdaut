<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

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

}
