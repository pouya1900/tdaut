<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    use HasFactory;


    protected $fillable = [
        'text',
        'type',
        'status',
        'rfp_id',
    ];


    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function rfp()
    {
        return $this->belongsTo(Rfp::class, 'rfp_id');
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
