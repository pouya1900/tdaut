<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report_type extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class, "report_type_id");
    }

}
