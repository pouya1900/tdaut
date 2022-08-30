<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function getLogoAttribute()
    {
        $image = $this->media()->where("model_type", 'productLogo')
            ->first();

        if (!empty($image)) {
            $path = Storage::disk("assetsStorage")->url('') . 'productLogo/';
            return $path . $image->title;
        }
        $path = Storage::disk("assetsStorage")->url('') . 'siteContent/';

        return $path . "ic_no_product_logo.png";
    }

    public function getImagesAttribute()
    {
        $image = $this->media()->where("model_type", 'productImage')
            ->get();
        $exist_image = [];

        if (!empty($image)) {
            $path = Storage::disk("assetsStorage")->url('') . 'productImage/';
            foreach ($image as $item) {
                $exist_image[] = $path . $item->title;
            }
            return $exist_image;
        }

        return [];
    }

    public function getVideosAttribute()
    {
        $image = $this->media()->where("model_type", 'productVideo')
            ->get();
        $exist_image = [];

        if (!empty($image)) {
            $path = Storage::disk("assetsStorage")->url('') . 'productVideo/';
            foreach ($image as $item) {
                $exist_image[] = $path . $item->title;
            }
            return $exist_image;
        }

        return [];
    }

    public function scopeActive($query)
    {
        $query->where('status', 'accepted');
    }


}
