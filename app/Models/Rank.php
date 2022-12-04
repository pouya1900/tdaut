<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function members()
    {
        return $this->hasMany(Member::class, "rank_id");
    }

}
