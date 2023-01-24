<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{

    public function index($path, $file)
    {
        if ($path == "tmp") {
            return abort(404);
        }

        return Storage::disk("privateStorage")->download($path . '/' . $file);
    }

}
