<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadTempImageRequest;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadUtilsTrait;

class MediaController extends Controller
{
    use UploadUtilsTrait;

    public function tmp(UploadTempImageRequest $request)
    {
        $file = $request->file('image');
        $media = $this->imageUpload($file, 'tmp', 'privateStorage');
        return ['name' => $media->title];

    }
}
