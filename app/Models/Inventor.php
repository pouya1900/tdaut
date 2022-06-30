<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventor extends Model
{
    use HasFactory;


    public function profile()
    {
        return $this->morphOne(Profile::class, 'profileable');
    }

    public function ideas()
    {
        return $this->hasMany(Idea::class, "inventor_id");
    }

}
