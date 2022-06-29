<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public function administrator()
    {
        return $this->belongsTo(Administrator::class, "seen_admin_id");
    }
}
