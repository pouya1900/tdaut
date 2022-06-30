<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\Office;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function index()
    {
        $admin = Administrator::find(1);

        dd($admin->profile->avatar);

    }

}
