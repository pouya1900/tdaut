<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Administrator extends Model
{
    use HasFactory;

    public function profile()
    {
        return $this->morphOne(Profile::class, 'profileable');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'seen_admin_id');
    }

    public function messages()
    {
        return $this->hasMany(Support_message::class, "admin_id");
    }

    public function profileImage()
    {
        return $this->morphOne(Media::class, 'mediable');
    }


    public function getAvatarAttribute()
    {
        $image = $this->profileImage()
            ->first();

        if (!empty($image)) {
            $path = Storage::disk("assetsStorage")->url('') . 'avatar/';
            return $path . $image->title;
        }
        $path = Storage::disk("assetsStorage")->url('') . 'siteContent/';

        return $path . "ic_no_avatar.png";
    }
}
