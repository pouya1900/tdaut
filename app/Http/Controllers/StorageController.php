<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{

    public function index($path, $file)
    {
        return Storage::disk("privateStorage")->download($path . '/' . $file);
    }

}
