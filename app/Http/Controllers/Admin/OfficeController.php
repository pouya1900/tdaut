<?php

namespace App\Http\Controllers\Admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateOfficeRequest;
use App\Models\Administrator;
use App\Models\Department;
use App\Models\Member;
use App\Models\Office;
use App\Traits\UploadUtilsTrait;
use Illuminate\Http\Request;

class OfficeController extends Controller
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

        $offices = Office::all();

        $data = [];

        foreach ($offices as $office) {
            $data[] = [
                'name'           => $office->name,
                'head'           => $office->head->profile->fullName,
                'department'     => $office->department->title,
                'status'         => Helper::officeStatusToTranslated($office->status),
                'status_message' => $office->status_message,
                'status_date'    => date('Y-m-d', strtotime($office->status_date)),
                'link'           => view('front.partials.action', ['link' => route('admin.office.members', ['office' => $office->id]), 'link_title' => trans('trs.members')])->render(),
                'action'         => view('front.partials.action', ['edit' => route('admin.office.edit', ['office' => $office->id]), 'remove' => route('admin.office.remove', ['office' => $office->id])])->render(),
            ];
        }

        return view('admin.offices.index', compact('offices', 'data', 'admin'));
    }

    public function edit(Office $office)
    {
        $admin = $this->request->admin;
        $departments = Department::all();
        $statuses = ['verified', 'rejected', 'pending', 'rfd'];
        return view('admin.offices.edit', compact('office', 'admin', 'departments', 'statuses'));
    }

    public function update(UpdateOfficeRequest $request, Office $office)
    {
        try {
            $status_date = $office->status_date;
            if ($office->status != $request->input('status')) {
                $status_date = date('Y-m-d H:i', strtotime('now'));
            }
            $office->update([
                "name"           => $request->input('name'),
                "about"          => $request->input('about') ?? "",
                "address"        => $request->input('address') ?? "",
                "phone"          => $request->input('phone'),
                "email"          => $request->input('email'),
                "admin_contact"  => $request->input('admin_contact'),
                "department_id"  => $request->input('department'),
                "projects_count" => $request->input('projects_count'),
                "status"         => $request->input('status'),
                "status_message" => $request->input('status_message'),
                "status_date"    => $status_date,
            ]);

            if ($request->input('deleted_image_image')) {
                $logo = $office->logoModel;
                if ($logo) {
                    $this->mediaRemove($logo, 'assetsStorage');
                }
            }
            if ($request->hasFile('image')) {
                $logo = $request->file('image');
                $this->imageUpload($logo, 'officeLogo', 'assetsStorage', $office);
            }

            return redirect(route('admin.offices'))->with('message', trans('trs.changed_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }

    }

    public function remove(Office $office)
    {
        $office->delete();
        return redirect(route('admin.offices'))->with('message', trans('trs.changed_successfully'));
    }

    public function members(Office $office)
    {
        $admin = $this->request->admin;

        $data = [];

        foreach ($office->members()->distinct()->get() as $member) {
            $roles_text = "";
            foreach ($member->roles as $role) {
                $roles_text ? $roles_text .= "," : '';
                $roles_text .= $role->title;
            }

            $data[] = [
                'name'   => $member->profile->fullName,
                'roles'  => $roles_text,
                'action' => view('front.partials.action', ['edit' => route('admin.member.roles', ['member' => $member->id, 'office' => $office->id])])->render(),
            ];
        }

        return view('admin.offices.members', compact('admin', 'office', 'data'));
    }


}
