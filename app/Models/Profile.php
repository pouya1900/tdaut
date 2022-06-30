<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    use HasFactory;

    public function profileable()
    {
        return $this->morphTo();
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }


    public function getAvatarAttribute()
    {
        $image = $this->media()->where('model_type', 'avatar')
            ->first();

        if (!empty($image)) {
            $path = Storage::disk("assetsStorage")->url('') . 'avatar/';
            return $path . $image->title;
        }
        $path = Storage::disk("assetsStorage")->url('') . 'siteContent/';

        return $path . "ic_no_avatar.png";
    }

    public function getCvAttribute()
    {
        $file = $this->media()->where('model_type', 'cv')
            ->first();

        if (!empty($file)) {
            $path = Storage::disk("assetsStorage")->url('') . 'cv/';
            return $path . $file->title;
        }

        return "";
    }

}
