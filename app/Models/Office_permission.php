<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office_permission extends Model
{
    use HasFactory;

    public function roles()
    {
        return $this->belongsToMany(Office_role::class, 'office_permission_role');
    }
}
