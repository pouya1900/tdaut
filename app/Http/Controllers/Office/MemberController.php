<?php

namespace App\Http\Controllers\Office;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOfficeMemberRequest;
use App\Http\Requests\UpdateMemberRoleRequest;
use App\Models\Member;
use App\Models\Office;
use App\Models\Office_role;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function __construct(Request $request, Office $office)
    {
        $this->request = $request;
        $this->office = $office;
    }


    public function index(Office $office)
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

    public function edit(Office $office, Member $member)
    {
        $roles = Office_role::all();

        $role_head = Office_role::where('name', 'head')->first();

        return view('office.members.edit', compact('office', 'member', 'roles', 'role_head'));
    }

    public function update(UpdateMemberRoleRequest $request, Office $office, Member $member)
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

    public function remove(Office $office, Member $member)
    {
        if ($member->isSuperAdmin($office->id)) {
            return redirect()->back()->withErrors(['error' => trans('trs.head_cant_remove')]);
        }

        $office->members()->detach($member->id);

        return redirect(route('mg.office_members', $office->id))->with('message', trans('trs.remove_member_success'));

    }

    public function create(Office $office)
    {
        $roles = Office_role::all();

        $role_head = Office_role::where('name', 'head')->first();
        return view('office.members.create', compact('office', 'roles', 'role_head'));
    }

    public function store(StoreOfficeMemberRequest $request, Office $office)
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

}
