<?php

namespace App\Traits;


use App\Models\Media;
use Illuminate\Support\Facades\Storage;

trait UploadUtilsTrait
{

    public function imageUpload($file, $model_type, $disk, $model = null)
    {
        Storage::disk($disk)->put($model_type, $file);
        [$width, $height] = getimagesize($file);

        if ($model) {
            $media = $model->media()->create([
                "title"      => $file->hashName(),
                "ext"        => $file->extension(),
                "size"       => $file->getSize() / 1024,
                "model_type" => $model_type,
                "width"      => $width,
                "height"     => $height,
            ]);
        } else {
            $media = Media::create([
                "title"  => $file->hashName(),
                "ext"    => $file->extension(),
                "size"   => $file->getSize() / 1024,
                "width"  => $width,
                "height" => $height,
            ]);
        }
        return $media;
    }

    public function videoUpload($file, $model, $model_type, $disk)
    {
        Storage::disk($disk)->put($model_type, $file);

        $media = $model->media()->create([
            "title"      => $file->hashName(),
            "model_type" => $model_type,
            "ext"        => $file->extension(),
            "size"       => $file->getSize() / 1024,
        ]);
    }

    public function documentUpload($file, $model_type, $disk, $model)
    {
        Storage::disk($disk)->put($model_type, $file);

        $media = $model->media()->create([
            "title"      => $file->hashName(),
            "ext"        => $file->extension(),
            "size"       => $file->getSize() / 1024,
            "model_type" => $model_type,
        ]);

        return $media;
    }

    public function mediaRemove($media, $disk)
    {
        if ($media) {
            Storage::disk($disk)->delete($media->model_type . '/' . $media->title);
            $media->delete();
        }
    }

}
