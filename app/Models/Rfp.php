<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Rfp extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'short_title',
        'goals',
        'achievements',
        'office_id',
        'user_id',
    ];

    public function office()
    {
        return $this->belongsTo(Office::class, "office_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'rfp_id');
    }

    public function getFileAttribute()
    {
        $file = $this->media()->where('model_type', 'rfp')
            ->first();

        if ($file) {
            $path = Storage::disk("privateStorage")->url('') . 'rfp/';
            return $path . $file->title;
        }

        return null;
    }


}
