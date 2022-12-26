<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Member;
use App\Models\Office;
use App\Models\Product;
use App\Models\User;
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

        $members = Member::all();
        $users = User::all();
        $offices = Office::all();
        $products = Product::all();

        return view('admin.dashboard.index', compact('admin', 'members', 'users', 'offices', 'products'));
    }
}
