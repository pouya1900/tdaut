<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{

    protected $fillable = [
        'title',
        'email',
        'address',
        'phone',
    ];
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
            $path = Storage::disk("assetsStorage")->url('') . 'logo/';
            return $path . $image->title;
        }
        $path = Storage::disk("assetsStorage")->url('') . 'siteContent/';

        return $path . 'aut_logo.png';
    }

    public function getLogoModelAttribute()
    {
        return $this->media()->where('model_type', 'logo')
            ->first();
    }

    public function getIconAttribute()
    {
        $image = $this->media()->where('model_type', 'icon')
            ->first();

        if (!empty($image)) {
            $path = Storage::disk("assetsStorage")->url('') . 'icon/';
            return $path . $image->title;
        }

        return "";
    }

    public function getIconModelAttribute()
    {
        return $this->media()->where('model_type', 'icon')
            ->first();
    }

    public function getBackgroundVideoAttribute()
    {
        $video = $this->media()->where('model_type', 'backgroundVideo')->first();

        if (!empty($video)) {
            $path = Storage::disk("assetsStorage")->url('') . 'backgroundVideo/';
            return $path . $video->title;
        }

        return "";
    }

    public function getBackgroundVideoModelAttribute()
    {
        return $this->media()->where('model_type', 'backgroundVideo')->first();
    }

    public function getBackgroundImageAttribute()
    {
        $image = $this->media()->where('model_type', 'backgroundImage')->first();

        if (!empty($image)) {
            $path = Storage::disk("assetsStorage")->url('') . 'backgroundImage/';
            return $path . $image->title;
        }

        return "";
    }

    public function getBackgroundImageModelAttribute()
    {
        return $this->media()->where('model_type', 'backgroundImage')->first();
    }


}
