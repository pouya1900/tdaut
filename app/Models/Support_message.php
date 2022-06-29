<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support_message extends Model
{
    use HasFactory;


    public function administrator()
    {
        return $this->belongsTo(Administrator::class, "admin_id");
    }

}
