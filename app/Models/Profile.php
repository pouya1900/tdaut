<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'gender',
        'birthday',
        'about',
        'linkedin',
        'github',
    ];

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

    public function getHasAvatarAttribute()
    {
        $image = $this->media()->where('model_type', 'avatar')
            ->first();
        if ($image) {
            return true;
        }
        return false;
    }

    public function getAvatarModelAttribute()
    {
        return $this->media()->where('model_type', 'avatar')
            ->first();
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

    public function getFullNameAttribute()
    {
        if ($this->type == "legal") {
            return $this->profileable->company_name;
        } else {
            return $this->first_name . " " . $this->last_name;
        }
    }

    public function getAgentFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;

    }

    public function getVisitCardAttribute()
    {
        $file = $this->media()->where('model_type', 'visitCard')
            ->first();

        if (!empty($file)) {
            $path = Storage::disk("assetsStorage")->url('') . 'visitCard/';
            return $path . $file->title;
        }

        return "";
    }
}
