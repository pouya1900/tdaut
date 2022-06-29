<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function professors()
    {
        return $this->hasMany(Professor::class, "department_id");
    }

    public function offices()
    {
        return $this->hasMany(Office::class, "department_id");
    }

    public function students()
    {
        return $this->hasMany(Student::class, "department_id");
    }

}
