<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    use HasFactory;

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }


    public function getLogoAttribute()
    {
        $image = $this->media()->where('model_type', 'logo')
            ->first();

        if (!empty($image)) {
            $path = Storage::disk("assetsStorage")->url('') . 'siteContent/';
            return $path . $image->title;
        }

        return "";
    }

    public function getIconAttribute()
    {
        $image = $this->media()->where('model_type', 'icon')
            ->first();

        if (!empty($image)) {
            $path = Storage::disk("assetsStorage")->url('') . 'siteContent/';
            return $path . $image->title;
        }

        return "";
    }

}
