<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\Office;
use App\Models\Setting;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function index(Request $request)
    {
        dd(asset('storage/a.jpeg'));
        $setting=Setting::first();
        dd($setting->logo);
       return view('layouts.front');

    }

}
