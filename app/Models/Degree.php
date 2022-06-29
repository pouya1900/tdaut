<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use HasFactory;

    public function students()
    {
        return $this->hasMany(Student::class, "degree_id");
    }


    public function staff()
    {
        return $this->hasMany(Staff::class, "degree_id");
    }

}
