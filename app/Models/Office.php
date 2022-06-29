<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;


    public function Capabilities()
    {
        return $this->hasMany(Capability::class, "office_id");
    }

    public function department()
    {
        return $this->belongsTo(Department::class, "department_id");
    }

    public function documents()
    {
        return $this->hasMany(Document::class, "office_id");
    }

    public function messages()
    {
        return $this->hasMany(Message::class, "office_id");
    }

    public function professors()
    {
        return $this->morphedByMany(Professor::class, "memberable", "office_members");
    }

    public function students()
    {
        return $this->morphedByMany(Student::class, "memberable", "office_members")->withPivot('role_id');
    }

    public function staff()
    {
        return $this->morphedByMany(Staff::class, "memberable", "office_members");
    }


    public function roles()
    {
        return $this->belongsToMany(Office_role::class,'office_members',"office_id",'role_id')->withPivot('memberable_type','memberable_id');
    }

}
