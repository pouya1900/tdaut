<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'link',
        'status',
        'status_message',
        'status_date',
    ];

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

    public function getLogoModelAttribute()
    {
        return $this->media()->where("model_type", 'productLogo')
            ->first();
    }

    public function getHasLogoAttribute()
    {
        $image = $this->media()->where("model_type", 'productLogo')
            ->first();
        if (!empty($image)) {
            return true;
        }
        return false;
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

    public function getImagesNameAttribute()
    {
        $images = $this->media()->where("model_type", 'productImage')->select('title as name')->get();
        return $images;
    }

    public function getImagesPathAttribute()
    {
        return Storage::disk("assetsStorage")->url('') . 'productImage/';
    }

    public function getVideoAttribute()
    {
        $video = $this->media()->where("model_type", 'productVideo')
            ->first();

        if (!empty($video)) {
            $path = Storage::disk("assetsStorage")->url('') . 'productVideo/';
            return $path . $video->title;
        }
        return null;
    }

    public function getVideoModelAttribute()
    {
        return $this->media()->where("model_type", 'productVideo')
            ->first();
    }

    public function scopeActive($query)
    {
        $query->where('status', 'accepted');
    }


}
