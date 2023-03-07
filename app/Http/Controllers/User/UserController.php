<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Profile;
use App\Models\User;
use App\Traits\UploadUtilsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    use UploadUtilsTrait;

    public function __construct(Request $request, Profile $profile, User $user)
    {
        $this->request = $request;
        $this->profile = $profile;
        $this->user = $user;
    }

    public function show(User $user)
    {
        if ($user->status != "verified" && (!$this->request->current_user || $this->request->current_user->id != $user->id)) {
            abort(404);
        }

        return view('front.users.show', compact('user'));
    }

    public function edit()
    {
        $user = $this->request->current_user;
        return view('front.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request)
    {
        $user = $this->request->current_user;

        try {
            $update = [
                'about'    => $request->input('about'),
                'linkedin' => $request->input('linkedin'),
            ];
            if ($user->type == "real") {
                $update['first_name'] = $request->input('first_name');
                $update['last_name'] = $request->input('last_name');
            }

            $user->profile()->update($update);

            if ($this->request->input('deleted_avatar')) {
                $this->mediaRemove($user->profile->avatarModel, 'assetsStorage');
            }

            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');

                $this->imageUpload($avatar, 'avatar', 'assetsStorage', $user->profile);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }

        return redirect(route('user_show', $user->id));
    }

    public function password()
    {
        $user = $this->request->current_user;
        return view('front.users.password', compact('user'));
    }

    public function update_password(UpdatePasswordRequest $request)
    {
        try {
            $user = $this->request->current_user;

            if (!Hash::check($request->input('old_password'), $user->password)) {
                return redirect()->back()->withErrors(['error' => trans('trs.wrong_old_password')]);
            }

            $user->update([
                'password' => bcrypt($request->input('password')),
            ]);

            return redirect(route('user_password'))->with('message', trans('trs.password_changed'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }


}
