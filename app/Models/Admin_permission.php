<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_permission extends Model
{
    use HasFactory;

    public function roles()
    {
        return $this->belongsToMany(Admin_role::class, 'admin_permission_role', 'permission_id', 'role_id');
    }

}
