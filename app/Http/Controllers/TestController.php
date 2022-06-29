<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function index()
    {
        $office=Office::find(1);

        dd($office->roles->first()->member());

    }

}
