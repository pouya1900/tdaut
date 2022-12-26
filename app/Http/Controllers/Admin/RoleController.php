<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRolePermissionRequest;
use App\Models\Admin_permission;
use App\Models\Admin_role;
use App\Models\Administrator;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(Request $request, Administrator $admin)
    {
        $this->request = $request;
        $this->admin = $admin;
    }

    public function index()
    {
        $admin = $this->request->admin;

        $data = [];

        $roles = Admin_role::all();

        foreach ($roles as $role) {

            $permission_text = "";
            $f = 0;
            foreach ($role->permissions as $permission) {
                if ($f) {
                    $permission_text .= ",";
                }
                $permission_text .= $permission->title;
                $f = 1;
            }

            $data[] = [
                'title'       => $role->title,
                'permissions' => $permission_text,
                'action'      => $role->name != "super" ? view('front.partials.action', ['edit' => route('admin.role.edit', ['role' => $role->id])])->render() : "",
            ];
        }
        return view('admin.admin_roles.index', compact('admin', 'data'));
    }


    public function edit(Admin_role $role)
    {
        $admin = $this->request->admin;

        $permissions = Admin_permission::all();

        return view('admin.admin_roles.edit', compact('admin', 'role', 'permissions'));
    }

    public function update(UpdateRolePermissionRequest $request, Admin_role $role)
    {
        $permissions = $request->input('permission');

        if ($role->name == "super") {
            return redirect()->withErrors(['error' => trans('trs.super_permission_cant_change')]);
        }

        $role->permissions()->detach();
        if ($permissions) {
            foreach ($permissions as $permission) {
                $role->permissions()->attach($permission);
            }
        }
        return redirect(route('admin.roles'))->with('message', trans('trs.changed_successfully'));
    }


}
