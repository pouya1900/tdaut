<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRolePermissionRequest;
use App\Models\Office;
use App\Models\Office_permission;
use App\Models\Office_role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function __construct(Request $request, Office $office)
    {
        $this->request = $request;
        $this->office = $office;
    }

    public function index(Office $office)
    {
        $data = [];
        foreach ($office->roles()->orderBy('role_id')->get()->unique('id') as $role) {
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
                'role'       => $role->title,
                'permission' => $permission_text,
                'action'     => $role->name != "head" ? view('front.partials.action', ['edit' => route('mg.office_roles_edit', ['office' => $office->id, 'role' => $role->id])])->render() : "",
            ];
        }

        return view('office.roles.index', compact('office', 'data'));
    }

    public function edit(Office $office, Office_role $role)
    {
        $permissions = Office_permission::all();

        return view('office.roles.edit', compact('office', 'role', 'permissions'));
    }

    public function update(UpdateRolePermissionRequest $request, Office $office, Office_role $role)
    {
        $permissions = $request->input('permission');

        if ($role->name == "head") {
            return redirect()->withErrors(['error' => trans('trs.head_permission_cant_change')]);
        }

        $role->permissions()->wherePivot('office_id', $office->id)->detach();
        if ($permissions) {
            foreach ($permissions as $permission) {
                $role->permissions()->attach($permission, ['office_id' => $office->id]);
            }
        }
        return redirect(route('mg.office_roles', $office->id));
    }



}
