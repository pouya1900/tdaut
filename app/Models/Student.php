<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;


    public function degree()
    {
        return $this->belongsTo(Degree::class, "degree_id");
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

}
