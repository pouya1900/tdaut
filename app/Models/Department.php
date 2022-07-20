<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;



    public function offices()
    {
        return $this->hasMany(Office::class, "department_id");
    }

    public function members()
    {
        return $this->hasMany(Member::class, "department_id");
    }

}
