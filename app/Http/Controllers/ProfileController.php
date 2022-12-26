<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\Degree;
use App\Models\Department;
use App\Models\Member;
use App\Models\Profile;
use App\Models\Rank;
use App\Models\User;
use App\Traits\UploadUtilsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    use UploadUtilsTrait;

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

    public function edit()
    {
        $member = $this->request->current_member;
        $departments = Department::all();
        $ranks = Rank::all();
        $degrees = Degree::all();
        return view('front.profile.edit', compact('member', 'departments', 'ranks', 'degrees'));
    }

    public function update()
    {
        $member = $this->request->current_member;

        $type = $this->request->input('type');

        $validation = [
            "type"       => "required|in:professor,student,staff",
            "first_name" => "required",
            "last_name"  => "required",
        ];
        $update = [];
        $update_profile = [
            'first_name' => $this->request->input('first_name'),
            'last_name'  => $this->request->input('last_name'),
            'about'      => $this->request->input('about'),
        ];

        if ($this->request->input('linkedin')) {
            $update_profile["linkedin"] = $this->request->input('linkedin');
        }
        if ($this->request->input('github')) {
            $update_profile["github"] = $this->request->input('github');
        }


        if ($type == "professor") {
            $update['rank_id'] = $this->request->input('rank');
            $update['department_id'] = $this->request->input('department');
            $update['group'] = $this->request->input('group');


            $validation["rank"] = "required|exists:ranks,id";
            $validation["department"] = "required|exists:departments,id";
            $validation["group"] = "required";
        } else if ($type == "student") {
            $update['department_id'] = $this->request->input('department');
            $update['degree_id'] = $this->request->input('degree');
            $update['student_number'] = $this->request->input('student_number');

            $validation["department"] = "required|exists:departments,id";
            $validation["degree"] = "required|exists:degrees,id";
            $validation["student_number"] = "required";

        } else if ($type == "staff") {
            $update['degree_id'] = $this->request->input('degree');

            $validation["degree"] = "required|exists:degrees,id";
        }

        $validator = Validator::make($this->request->all(), $validation);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        try {
            $member->update($update);
            $member->profile->update($update_profile);

            if ($this->request->hasFile('resume')) {
                $file = $this->request->file('resume');
                Storage::disk("assetsStorage")->put('cv', $file);

                $member->profile->media()->create([
                    "title"      => $file->hashName(),
                    "model_type" => "cv",
                    "ext"        => $file->extension(),
                    "size"       => $file->getSize() / 1024,
                ]);
            }

            if ($this->request->input('deleted_avatar')) {
                $this->mediaRemove($member->profile->avatarModel, 'assetsStorage');
            }

            if ($this->request->hasFile('avatar')) {
                $avatar = $this->request->file('avatar');

                $this->imageUpload($avatar, 'avatar', 'assetsStorage', $member->profile);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }


        return redirect(route('profile_show', $member->id));

    }

    public function offices(Member $member)
    {
        return view('front.profile.offices', compact('member'));
    }

    public function password()
    {
        $member = $this->request->current_member;
        return view('front.profile.password', compact('member'));
    }

    public function update_password(UpdatePasswordRequest $request)
    {
        $member = $this->request->current_member;

        if (!Hash::check($request->input('old_password'), $member->password)) {
            return redirect()->back()->withErrors(['error' => trans('trs.wrong_old_password')]);
        }

        $member->update([
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect(route('profile_password'))->with('message', trans('trs.password_changed'));

    }


    public function search()
    {
        $string = $this->request->input('str');

        $members = Member::wherehas('profile', function ($q) use ($string) {
            return $q->where('username', 'like', "%$string%")->orwhere('first_name', 'like', "%$string%")->orwhere('last_name', 'like', "%$string%");
        })->orwhere('email', 'like', "%$string%")->get();

        $response = [];

        foreach ($members as $member) {
            $response[] = [
                'name'   => $member->profile->fullName,
                'id'     => $member->id,
                'avatar' => $member->profile->avatar,
            ];
        }
        return json_encode($response);
    }


}
