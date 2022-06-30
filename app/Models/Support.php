<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    public function supportable()
    {
        return $this->morphTo();
    }

    public function messages()
    {
        return $this->hasMany(Support_message::class, 'support_id');
    }
}
