<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office_role extends Model
{
    use HasFactory;

    public function students()
    {
        return $this->morphedByMany(Student::class, "memberable", "office_members")->withPivot('office_id');
    }

    public function member()
    {
        $type=$this->pivot->memberable_type;
        $id=$this->pivot->memberable_id;
        $a=$this->morphedByMany($type, "memberable", "office_members");

        dd($a);

    }

}
