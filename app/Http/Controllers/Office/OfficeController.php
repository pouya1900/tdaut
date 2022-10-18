<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOfficeRequest;
use App\Models\Department;
use App\Models\Office;
use App\Models\Office_permission;
use App\Models\Office_role;
use Illuminate\Http\Request;

class OfficeController extends Controller
{

    public function __construct(Request $request, Office $office)
    {
        $this->request = $request;
        $this->office = $office;
    }

    public function index(Office $office)
    {
        $departments = Department::all();

        return view('office.index.index', compact('office', 'departments'));
    }

    public function create()
    {
        $member = $this->request->current_member;

        if ($member->type != "professor") {
            return redirect()->back()->withErrors(['error' => trans('trs.only_professor_can_create')]);
        }

        if ($member->roles->where('name', 'head')->first()) {
            return redirect()->back()->withErrors(['error' => trans('trs.only_one_office_can_create')]);
        }

        $departments = Department::all();

        return view('office.create.create', compact('departments'));

    }

    public function store(StoreOfficeRequest $request)
    {

        $member = $this->request->current_member;

        if ($member->type != "professor") {
            return redirect()->back()->withErrors(['error' => trans('trs.only_professor_can_create')]);
        }

        if ($member->roles->where('name', 'head')->first()) {
            return redirect()->back()->withErrors(['error' => trans('trs.only_one_office_can_create')]);
        }

        $office = Office::create([
            "name"           => $request->input('name'),
            "about"          => $request->input('about') ?? "",
            "phone"          => $request->input('phone'),
            "email"          => $request->input('email'),
            "department_id"  => $request->input('department'),
            "projects_count" => $request->input('projects_count'),
            "status"         => "pending",
        ]);

        if (!$office) {
            return redirect()->back()->withErrors(['error' => trans('trs.office_not_created')]);
        }

        $role_head = Office_role::where('name', 'head')->first();
        $head_permission = Office_permission::where('name', '*')->first();

        $now = date('Y-m-d H:i:s', strtotime('now'));

        $office->members()->attach($member->id, ['role_id' => $role_head->id, 'created_at' => $now, 'updated_at' => $now]);

        $role_head->permissions()->attach($head_permission->id, ['office_id' => $office->id, 'created_at' => $now, 'updated_at' => $now]);

        return redirect(route('mg.office', $office->id))->with('message', trans('office_created_wait_for_verify'));

    }

    public function update(StoreOfficeRequest $request, Office $office)
    {
        $member = $this->request->current_member;

        $office->update([
            "name"           => $request->input('name'),
            "about"          => $request->input('about') ?? "",
            "address"        => $request->input('address') ?? "",
            "phone"          => $request->input('phone'),
            "email"          => $request->input('email'),
            "admin_contact"  => $request->input('admin_contact'),
            "department_id"  => $request->input('department'),
            "projects_count" => $request->input('projects_count'),
        ]);

        return redirect(route('mg.office', $office->id))->with('message', trans('trs.changed_successfully'));
    }

    public function capabilities(Office $office)
    {
        return view('office.capabilities.edit', compact('office'));
    }

    public function capabilities_update(Office $office)
    {
        $office->capabilities()->delete();
        foreach ($this->request->capabilities as $capability) {
            if ($capability) {
                $office->capabilities()->create([
                    'text' => $capability,
                ]);
            }
        }

        return redirect(route('mg.office_capabilities', $office->id))->with('message', trans('trs.changed_successfully'));

    }

    public function members(Office $office)
    {
        return view('office.members.index', compact('office'));
    }

}
