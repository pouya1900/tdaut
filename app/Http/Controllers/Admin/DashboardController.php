<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(Request $request, Administrator $admin)
    {
        $this->request = $request;
        $this->admin = $admin;
    }

    public function index()
    {
        $admin = $this->request->admin;
        return view('admin.dashboard.index', compact('admin'));
    }
}
