<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office_role extends Model
{
    use HasFactory;


    public function members($office_id = null)
    {
        if ($office_id) {
            return $this->belongsToMany(Member::class, "office_member", 'role_id', 'member_id')->where('office_id', $office_id);
        }

        if ($this->pivot && $office_id = $this->pivot->office_id) {
            return $this->belongsToMany(Member::class, "office_member", 'role_id', 'member_id')->where('office_id', $office_id);
        }
        return $this->belongsToMany(Member::class, "office_member", 'role_id', 'member_id');
    }

    public function offices()
    {
        if ($this->pivot && $member_id = $this->pivot->member_id) {
            return $this->belongsToMany(Office::class, "office_member", 'role_id', 'office_id')->where('member_id', $member_id);
        }
        return $this->belongsToMany(Office::class, 'office_member', 'role_id', 'office_id');
    }

    public function permissions($office_id = null)
    {
        if ($office_id) {
            return $this->belongsToMany(Office_permission::class, 'office_permission_role', 'role_id', 'permission_id')->where('office_id', $office_id);
        }

        if ($this->pivot && $office_id = $this->pivot->office_id) {
            return $this->belongsToMany(Office_permission::class, 'office_permission_role', 'role_id', 'permission_id')->where('office_id', $office_id);
        }

        return $this->belongsToMany(Office_permission::class, 'office_permission_role', 'role_id', 'permission_id');
    }

}
