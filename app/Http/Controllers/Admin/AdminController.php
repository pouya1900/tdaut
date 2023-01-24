<?php

namespace App\Http\Controllers\Admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\Admin_role;
use App\Models\Administrator;
use App\Traits\UploadUtilsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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

        $administrators = Administrator::all();

        foreach ($administrators as $administrator) {
            $data[] = [
                'name'   => $administrator->profile->fullName,
                'email'  => $administrator->email,
                'role'   => $administrator->role->title,
                'action' => view('front.partials.action', ['edit' => route('admin.admin.edit', ['administrator' => $administrator->id]), 'remove' => route('admin.admin.remove', ['administrator' => $administrator->id])])->render(),
            ];
        }
        return view('admin.admins.index', compact('admin', 'data'));
    }

    public function edit(Administrator $administrator)
    {
        $admin = $this->request->admin;

        $roles = Admin_role::all();

        return view('admin.admins.edit', compact('roles', 'administrator', 'admin'));

    }

    public function update(UpdateAdminRequest $request, Administrator $administrator)
    {
        try {
            DB::beginTransaction();

            $administrator->update([
                'email'   => $request->input('email'),
                'role_id' => $request->input('role'),
            ]);

            if (!Administrator::whereHas('role', function ($q) {
                return $q->where('name', 'super');
            })->first()) {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => trans('trs.cant_remove_super_role')]);
            }
            DB::commit();

            $administrator->profile->update([
                'first_name' => $request->input('first_name'),
                'last_name'  => $request->input('last_name'),
            ]);

            if ($request->input('deleted_image_image')) {
                $avatar = $administrator->profile->avatarModel;
                if ($avatar) {
                    $this->mediaRemove($avatar, 'assetsStorage');
                }
            }
            if ($request->hasFile('image')) {
                $avatar = $request->file('image');
                $this->imageUpload($avatar, 'avatar', 'assetsStorage', $administrator->profile);
            }

            return redirect(route('admin.admins'))->with('message', trans('trs.changed_successfully'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }

    public function create()
    {
        $admin = $this->request->admin;
        $roles = Admin_role::all();

        return view('admin.admins.create', compact('roles', 'admin'));
    }

    public function store(StoreAdminRequest $request)
    {
        try {

            $administrator = Administrator::create([
                'email'    => $request->input('email'),
                'role_id'  => $request->input('role'),
                'password' => bcrypt($request->input('password')),
            ]);


            $administrator->profile()->create([
                'first_name' => $request->input('first_name'),
                'last_name'  => $request->input('last_name'),
            ]);

            if ($request->hasFile('image')) {
                $avatar = $request->file('image');
                $this->imageUpload($avatar, 'avatar', 'assetsStorage', $administrator->profile);
            }

            return redirect(route('admin.admins'))->with('message', trans('trs.changed_successfully'));

        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }

    public function remove(Administrator $administrator)
    {
        $administrator->delete();
        return redirect(route('admin.admins'))->with('message', trans('trs.changed_successfully'));
    }
}
