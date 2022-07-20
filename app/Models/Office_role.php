<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office_role extends Model
{
    use HasFactory;


    public function getMembersAttribute()
    {
        if ($this->pivot && $office_id = $this->pivot->office_id) {
            return $this->belongsToMany(Member::class, "office_member", 'role_id', 'member_id')->where('office_id', $office_id)->get();
        }
        return $this->belongsToMany(Member::class, "office_member", 'role_id', 'member_id')->get()->unique('id');
    }

    public function getOfficesAttribute()
    {
        if ($this->pivot && $member_id = $this->pivot->member_id) {
            return $this->belongsToMany(Office::class, "office_member", 'role_id', 'office_id')->where('member_id', $member_id)->get();
        }
        return $this->belongsToMany(Office::class, 'office_member', 'role_id', 'office_id')->get()->unique('id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Office_permission::class, 'office_permission_role');
    }

}
