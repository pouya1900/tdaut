<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capability extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
    ];

    public function office()
    {
        return $this->belongsTo(Office::class, "office_id");
    }

}
