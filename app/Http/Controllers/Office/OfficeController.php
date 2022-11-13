<?php

namespace App\Http\Controllers\Office;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOfficeMemberRequest;
use App\Http\Requests\StoreOfficeRequest;
use App\Http\Requests\StoreProposalRequest;
use App\Http\Requests\supportMessageRequest;
use App\Http\Requests\supportStoreRequest;
use App\Http\Requests\UpdateMemberRoleRequest;
use App\Http\Requests\UpdateRolePermissionRequest;
use App\Models\Department;
use App\Models\Document;
use App\Models\Member;
use App\Models\Office;
use App\Models\Office_permission;
use App\Models\Office_role;
use App\Models\Support;
use App\Models\User;
use App\Traits\UploadUtilsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfficeController extends Controller
{
    use UploadUtilsTrait;

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

        if ($request->input('deleted_logo')) {
            $logo = $office->logoModel;
            if ($logo) {
                $this->mediaRemove($logo, 'assetsStorage');
            }
        }
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $this->imageUpload($logo, 'officeLogo', 'assetsStorage', $office);
        }

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

    public function content_edit(Office $office)
    {
        return view('office.text.edit', compact('office'));
    }

    public function content_update(Office $office)
    {
        $content = $this->request->input('content');

        $office->update([
            'content' => $content,
        ]);

        return redirect(route('mg.content_edit', $office->id))->with('message', trans('trs.changed_successfully'));
    }


}
