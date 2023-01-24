<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Office_role;
use Illuminate\Http\Request;

class OfficeRoleController extends Controller
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

        $roles = Office_role::all();

        foreach ($roles as $role) {
            $data[] = [
                'title'  => $role->title,
                'action' => $role->name!="head" && $role->name!="board" ? view('front.partials.action', ['edit' => route('admin.office-role.edit', ['role' => $role->id]), 'remove' => route('admin.office-role.remove', ['role' => $role->id])])->render() : "",
            ];
        }

        return view('admin.office_roles.index', compact('admin', 'data'));

    }

    public function create()
    {
        $admin = $this->request->admin;

        return view('admin.office_roles.create', compact('admin'));
    }

    public function store()
    {
        if ($this->request->input('name') == "head" || $this->request->input('name') == "board") {
            return redirect()->back()->withErrors(['error' => trans('trs.head_permission_cant_change')]);
        }

        try {
            Office_role::create([
                'title' => $this->request->input('title'),
                'name'  => $this->request->input('name'),
            ]);
            return redirect(route('admin.office-roles'))->with('message', trans('trs.changed_successfully'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }

    public function edit(Office_role $role)
    {
        $admin = $this->request->admin;

        return view('admin.office_roles.edit', compact('admin', 'role'));
    }

    public function update(Office_role $role)
    {
        if ($this->request->input('name') == "head" || $this->request->input('name') == "board") {
            return redirect()->back()->withErrors(['error' => trans('trs.head_permission_cant_change')]);
        }

        try {
            $role->update([
                'title' => $this->request->input('title'),
                'name'  => $this->request->input('name'),
            ]);
            return redirect(route('admin.office-roles'))->with('message', trans('trs.changed_successfully'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }

    public function remove(Office_role $role)
    {
        try {
            $role->members()->detach();
            $role->permissions()->detach();
            $role->delete();
            return redirect(route('admin.office-roles'))->with('message', trans('trs.changed_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }
}
