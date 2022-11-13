<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(Request $request, Profile $profile, User $user)
    {
        $this->request = $request;
        $this->profile = $profile;
        $this->user = $user;
    }

    public function show(User $user)
    {
        return view('front.users.show', compact('user'));
    }

}
