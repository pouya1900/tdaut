<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office_role extends Model
{
    use HasFactory;

    public function member()
    {
        $type = $this->pivot->memberable_type;
        $id = $this->pivot->memberable_id;
        return $this->morphedByMany($type, "memberable", "office_members", 'role_id')->where('memberable_id', $id)->first();
    }

    public function permissions()
    {
        return $this->belongsToMany(Office_permission::class, 'office_permission_role');
    }

}
