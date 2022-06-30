<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Office extends Model
{
    use HasFactory;


    public function Capabilities()
    {
        return $this->hasMany(Capability::class, "office_id");
    }

    public function department()
    {
        return $this->belongsTo(Department::class, "department_id");
    }

    public function documents()
    {
        return $this->hasMany(Document::class, "office_id");
    }

    public function messages()
    {
        return $this->hasMany(Message::class, "office_id");
    }

    public function professors()
    {
        return $this->morphedByMany(Professor::class, "memberable", "office_members")->withPivot('role_id');
    }

    public function students()
    {
        return $this->morphedByMany(Student::class, "memberable", "office_members")->withPivot('role_id');
    }

    public function staff()
    {
        return $this->morphedByMany(Staff::class, "memberable", "office_members")->withPivot('role_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Office_role::class, "office_members", "office_id", 'role_id')->withPivot('memberable_type', 'memberable_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, "office_id");
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function supports()
    {
        return $this->morphMany(Support::class, 'supportable');
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function getLogoAttribute()
    {
        $image = $this->media()->where("model_type", 'officeLogo')
            ->first();

        if (!empty($image)) {
            $path = Storage::disk("assetsStorage")->url('') . 'officeLogo/';
            return $path . $image->title;
        }
        $path = Storage::disk("assetsStorage")->url('') . 'siteContent/';

        return $path . "ic_no_office_logo.png";
    }

    public function getSlideshowAttribute()
    {
        $image = $this->media()->where("model_type", 'officeSlideshow')
            ->get();
        $exist_image = [];
        if (!empty($image)) {
            $path = Storage::disk("assetsStorage")->url('') . 'officeSlideshow/';
            foreach ($image as $item) {
                $exist_image[] = $path . $item->title;
            }
            return $exist_image;
        }

        return [];
    }

}
