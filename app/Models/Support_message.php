<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support_message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender',
        'admin_id',
        'text',
    ];

    public function administrator()
    {
        return $this->belongsTo(Administrator::class, "admin_id");
    }

    public function support()
    {
        return $this->belongsTo(Support::class, 'support_id');
    }
}
