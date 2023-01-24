<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public function reportable()
    {
        return $this->morphTo();
    }

    public function type()
    {
        return $this->belongsTo(Report_type::class, "report_type_id");
    }

}
