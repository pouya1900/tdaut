<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventor extends Model
{
    use HasFactory;

    public function ideas()
    {
        return $this->hasMany(Idea::class, "inventor_id");
    }

}
