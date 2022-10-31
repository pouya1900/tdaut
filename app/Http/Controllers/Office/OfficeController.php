<?php

namespace App\Http\Controllers\Office;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOfficeMemberRequest;
use App\Http\Requests\StoreOfficeRequest;
use App\Http\Requests\supportMessageRequest;
use App\Http\Requests\supportStoreRequest;
use App\Http\Requests\UpdateMemberRoleRequest;
use App\Http\Requests\UpdateRolePermissionRequest;
use App\Models\Department;
use App\Models\Member;
use App\Models\Office;
use App\Models\Office_permission;
use App\Models\Office_role;
use App\Models\Support;
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
        $data = [];
        foreach ($office->members()->orderBy('role_id')->distinct()->get() as $member) {
            $role_text = "";
            $f = 0;
            foreach ($member->roles as $role) {
                if ($f) {
                    $role_text .= ",";
                }
                $role_text .= $role->title;
                $f = 1;
            }
            $data[] = [
                'name'     => $member->profile->fullName,
                'type'     => Helper::memberType($member->type),
                'username' => $member->profile->username,
                'gender'   => Helper::genderToTranslated($member->profile->gender),
                'role'     => $role_text,
                'action'   => view('office.includes.action', ['edit' => route('mg.office_members_edit', ['office' => $office->id, 'member' => $member->id]), 'remove' => route('mg.office_members_remove', ['office' => $office->id, 'member' => $member->id])])->render(),
            ];
        }

        return view('office.members.index', compact('office', 'data'));
    }

    public function edit_members(Office $office, Member $member)
    {
        $roles = Office_role::all();

        $role_head = Office_role::where('name', 'head')->first();

        return view('office.members.edit', compact('office', 'member', 'roles', 'role_head'));
    }

    public function update_members(UpdateMemberRoleRequest $request, Office $office, Member $member)
    {
        $roles = $request->input('role');

        $role_head = Office_role::where('name', 'head')->first();
        $office->members()->wherePivot('role_id', '!=', $role_head->id)->detach($member->id);
        foreach ($roles as $role) {
            if ($role == $role_head->id) {
                continue;
            }
            $office->members()->attach($member->id, ['role_id' => $role]);
        }

        return redirect(route('mg.office_members', $office->id));

    }

    public function remove_members(Office $office, Member $member)
    {
        if ($member->isSuperAdmin($office->id)) {
            return redirect()->back()->withErrors(['error' => trans('trs.head_cant_remove')]);
        }

        $office->members()->detach($member->id);

        return redirect(route('mg.office_members', $office->id))->with('message', trans('trs.remove_member_success'));

    }

    public function create_member(Office $office)
    {
        $roles = Office_role::all();

        $role_head = Office_role::where('name', 'head')->first();
        return view('office.members.create', compact('office', 'roles', 'role_head'));
    }

    public function store_member(StoreOfficeMemberRequest $request, Office $office)
    {
        $member_id = $request->input('member_id');

        $roles = $request->input('role');
        $role_head = Office_role::where('name', 'head')->first();

        if ($office->members()->find($member_id)) {
            return redirect()->back()->withErrors(['error' => trans('trs.member_exist_office')]);
        }

        foreach ($roles as $role) {
            if ($role == $role_head->id) {
                continue;
            }
            $office->members()->attach($member_id, ['role_id' => $role]);
        }

        return redirect(route('mg.office_members', $office->id));
    }

    public function roles(Office $office)
    {
        $data = [];
        foreach ($office->roles()->orderBy('role_id')->distinct()->get() as $role) {
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
                'action'     => $role->name != "head" ? view('office.includes.action', ['edit' => route('mg.office_roles_edit', ['office' => $office->id, 'role' => $role->id])])->render() : "",
            ];
        }

        return view('office.roles.index', compact('office', 'data'));
    }

    public function edit_roles(Office $office, Office_role $role)
    {
        $permissions = Office_permission::all();

        return view('office.roles.edit', compact('office', 'role', 'permissions'));
    }

    public function update_roles(UpdateRolePermissionRequest $request, Office $office, Office_role $role)
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


    public function supports(Office $office)
    {
        $data = [];
        foreach ($office->supports as $support) {
            $data[] = [
                'title'      => $support->title,
                'created_at' => date('Y-m-d H:i', strtotime($support->created_at)),
                'status'     => view('office.includes.status', ['status' => $support->status])->render(),
                'action'     => view('office.includes.action', ['show' => route('mg.support_show', ['office' => $office->id, 'support' => $support->id])])->render(),
            ];
        }

        return view('office.supports.index', compact('office', 'data'));
    }

    public function support_show(Office $office, Support $support)
    {
        return view('office.supports.show', compact('office', 'support'));
    }

    public function support_new_message(supportMessageRequest $request, Office $office, Support $support)
    {
        $support->messages()->create([
            'sender' => 'user',
            'text'   => $request->input('message'),
        ]);

        return redirect(route('mg.support_show', ['office' => $office->id, 'support' => $support->id]));
    }

    public function support_new_ticket(Office $office)
    {
        return view('office.supports.create', compact('office'));
    }

    public function support_new_ticket_store(supportStoreRequest $request, Office $office)
    {
        $support = $office->supports()->create([
            'title' => $request->input('title'),
        ]);

        $support->messages()->create([
            'sender' => 'user',
            'text'   => $request->input('message'),
        ]);

        return redirect(route('mg.support_show', ['office' => $office->id, 'support' => $support->id]));

    }


}
