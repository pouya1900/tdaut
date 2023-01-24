<?php

namespace App\Http\Controllers\Admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateMemberRequest;
use App\Models\Administrator;
use App\Models\Degree;
use App\Models\Department;
use App\Models\Member;
use App\Models\Office;
use App\Models\Office_role;
use App\Models\Rank;
use App\Traits\UploadUtilsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class MemberController extends Controller
{
    use UploadUtilsTrait;

    public function __construct(Request $request, Administrator $admin)
    {
        $this->request = $request;
        $this->admin = $admin;
    }

    public function index(Office $office = null)
    {
        $admin = $this->request->admin;
        $data = [];

        $type = $this->request->type;

        $member_instance = new Member();
        if ($office) {
            $member_instance = $office->members();
        }

        $members = $member_instance->when($type, function ($q) use ($type) {
            return $q->where('type', $type);
        })->get();

        foreach ($members as $member) {
            $data[] = [
                'name'     => $member->profile->fullName,
                'username' => $member->profile->username,
                'email'    => $member->email,
                'type'     => Helper::memberType($member->type),
                'link'     => view('front.partials.action', ['link' => route('admin.member.offices', ['member' => $member->id]), 'link_title' => trans('trs.offices')])->render(),
                'action'   => view('front.partials.action', ['edit' => route('admin.member.edit', ['member' => $member->id]), 'remove' => route('admin.member.remove', ['member' => $member->id])])->render(),
            ];
        }
        return view('admin.members.index', compact('admin', 'data', 'type'));
    }

    public function edit(Member $member)
    {
        $admin = $this->request->admin;

        $ranks = Rank::all();
        $departments = Department::all();
        $degrees = Degree::all();

        return view('admin.members.edit', compact('member', 'admin', 'ranks', 'departments', 'degrees'));

    }

    public function update(UpdateMemberRequest $request, Member $member)
    {
        try {
            $member->update([
                'email'      => $request->input('email'),
                'department' => $request->input('department') ?? null,
                'rank'       => $request->input('rank') ?? null,
                'degree'     => $request->input('rank') ?? null,
                'group'      => $request->input('group') ?? null,
            ]);

            $member->profile->update([
                'first_name' => $request->input('first_name'),
                'last_name'  => $request->input('last_name'),
                'username'   => $request->input('username'),
                'about'      => $request->input('about'),
                'gender'     => $request->input('gender'),
                'linkedin'   => $request->input('linkedin'),
                'github'     => $request->input('github'),
            ]);

            if ($request->input('deleted_image_image')) {
                $avatar = $member->profile->avatarModel;
                if ($avatar) {
                    $this->mediaRemove($avatar, 'assetsStorage');
                }
            }
            if ($request->hasFile('image')) {
                $avatar = $request->file('image');
                $this->imageUpload($avatar, 'avatar', 'assetsStorage', $member->profile);
            }

            return redirect(route('admin.members'))->with('message', trans('trs.changed_successfully'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }

    public function remove(Member $member)
    {
        try {
            $member->profile()->delete();
            $member->delete();
            return redirect(route('admin.members'))->with('message', trans('trs.changed_successfully'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }

    public function offices(Member $member)
    {
        $admin = $this->request->admin;

        $data = [];

        foreach ($member->offices()->distinct()->get() as $office) {
            $roles_text = "";
            foreach ($office->roles as $role) {
                $roles_text ? $roles_text .= "," : '';
                $roles_text .= $role->title;
            }

            $data[] = [
                'name'   => $office->name,
                'roles'  => $roles_text,
                'action' => view('front.partials.action', ['edit' => route('admin.member.roles', ['member' => $member->id, 'office' => $office->id, 'from' => 'member'])])->render(),
            ];
        }

        return view('admin.members.offices', compact('admin', 'member', 'data'));
    }


    public function roles(Office $office, Member $member)
    {
        $admin = $this->request->admin;
        $from = $this->request->input('from');

        $roles = Office_role::all();

        $member_roles = $member->roles($office->id)->distinct()->pluck('office_roles.id')->toArray();

        return view('admin.members.roles', compact('member', 'office', 'admin', 'roles', 'member_roles', 'from'));
    }

    public function roles_update(Office $office, Member $member)
    {
        $roles = $this->request->input('role');
        $from = $this->request->input('from');

        try {
            DB::beginTransaction();

            $office->members()->detach($member->id);
            foreach ($roles as $role) {
                $office->members()->attach($member->id, ['role_id' => $role]);
            }

            if (!$office->roles()->where('name', 'head')->first()) {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => trans('trs.cant_remove_head_role')]);
            }

            DB::commit();

            if ($from == "member") {
                $route = 'admin.member.offices';
                $id = $member->id;
            } else {
                $route = 'admin.office.members';
                $id = $office->id;
            }
            return redirect(route($route, $id))->with('message', trans('trs.changed_successfully'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }

    }

    public function professors_insert()
    {
        $admin = $this->request->admin;

        return view('admin.members.insert_professors', compact('admin'));
    }

    public function professors_do_insert()
    {

        try {
            $the_file = $this->request->file('file');

            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $row_limit = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range = range(2, $row_limit);
            $column_range = range('F', $column_limit);
            $startcount = 2;
            foreach ($row_range as $row) {

                if (!$sheet->getCell('C' . $row)->getValue() || !$sheet->getCell('F' . $row)->getValue()) {
                    continue;
                }

                if (Member::where('email', $sheet->getCell('F' . $row)->getValue())->first()) {
                    continue;
                }

                $member = Member::create([
                    'email'    => $sheet->getCell('F' . $row)->getValue(),
                    'password' => '',
                    'type'     => 'professor',
                ]);

                $member->profile()->create([
                    'first_name' => $sheet->getCell('A' . $row)->getValue(),
                    'last_name'  => $sheet->getCell('B' . $row)->getValue(),
                    'username'   => $sheet->getCell('C' . $row)->getValue(),
                ]);

                $startcount++;
            }

            return redirect(route('admin.members') . "?type=professor");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }


}
