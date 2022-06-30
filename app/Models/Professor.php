<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    public function profile()
    {
        return $this->morphOne(Profile::class, 'profileable');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, "department_id");
    }

    public function offices()
    {
        return $this->morphToMany(Office::class, "memberable", "office_members");
    }

    public function roles()
    {
        return $this->morphToMany(Office_role::class, "memberable", "office_members", "", "role_id");
    }

    public function role()
    {
        $role_id = $this->pivot->role_id;
        return Office_role::find($role_id);
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class, 'rank_id');
    }

}
