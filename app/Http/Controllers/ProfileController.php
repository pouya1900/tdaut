<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(Request $request, Profile $profile, Member $member)
    {
        $this->request = $request;
        $this->profile = $profile;
        $this->member = $member;
    }

    public function index()
    {
    }

    public function show(Member $member)
    {
        return view('front.profile.show', compact('member'));
    }

}
