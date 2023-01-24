<?php

namespace App\Http\Controllers\Admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Administrator;
use App\Models\Role;
use App\Models\User;
use App\Traits\UploadUtilsTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use UploadUtilsTrait;

    public function __construct(Request $request, Administrator $admin)
    {
        $this->request = $request;
        $this->admin = $admin;
    }

    public function index()
    {
        $admin = $this->request->admin;
        $data = [];

        $filter = $this->request->filter;
        $users = User::when($filter, function ($q) use ($filter) {
            return $q->where('status', $filter);
        })->get();

        foreach ($users as $user) {
            $data[] = [
                'name'           => $user->profile->fullName,
                'username'       => $user->profile->username,
                'email'          => $user->email,
                'role'           => $user->role->title,
                'type'           => Helper::userType($user->type),
                'status'         => Helper::userStatusToTranslated($user->status),
                'status_message' => $user->status_message,
                'status_date'    => date('Y-m-d', strtotime($user->status_date)),
                'action'         => view('front.partials.action', ['edit' => route('admin.user.edit', ['user' => $user->id]), 'remove' => route('admin.user.remove', ['user' => $user->id])])->render(),
            ];
        }
        return view('admin.users.index', compact('admin', 'data', 'filter'));
    }

    public function edit(User $user)
    {
        $admin = $this->request->admin;

        $roles = Role::all();
        $types = ['real', 'legal'];
        $statuses = ['verified', 'rejected', 'pending', 'rfd'];

        return view('admin.users.edit', compact('roles', 'types', 'statuses', 'user', 'admin'));

    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {

            $status_date = $user->status_date;
            if ($user->status != $request->input('status')) {
                $status_date = date('Y-m-d H:i', strtotime('now'));
            }
            $user->update([
                'email'          => $request->input('email'),
                'role_id'        => $request->input('role'),
                'type'           => $request->input('type'),
                'status'         => $request->input('status'),
                'status_message' => $request->input('status_message'),
                'status_date'    => $status_date,
            ]);

            $user->profile->update([
                'first_name' => $request->input('first_name'),
                'last_name'  => $request->input('last_name'),
                'username'   => $request->input('username'),
                'about'      => $request->input('about'),
                'gender'     => $request->input('gender'),
                'linkedin'   => $request->input('linkedin'),
                'github'     => $request->input('github'),
            ]);

            if ($request->input('deleted_image_image')) {
                $avatar = $user->profile->avatarModel;
                if ($avatar) {
                    $this->mediaRemove($avatar, 'assetsStorage');
                }
            }
            if ($request->hasFile('image')) {
                $avatar = $request->file('image');
                $this->imageUpload($avatar, 'avatar', 'assetsStorage', $user->profile);
            }

            return redirect(route('admin.users'))->with('message', trans('trs.changed_successfully'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }

    public function remove(User $user)
    {
        try {
            $user->profile()->delete();
            $user->delete();
            return redirect(route('admin.users'))->with('message', trans('trs.changed_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }

    }
}
