<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Degree;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
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

        $departments = Department::all();

        foreach ($departments as $department) {
            $data[] = [
                'title'  => $department->title,
                'action' => view('front.partials.action', ['edit' => route('admin.department.edit', ['department' => $department->id]), 'remove' => route('admin.department.remove', ['department' => $department->id])])->render(),
            ];
        }

        return view('admin.departments.index', compact('admin', 'data'));

    }

    public function create()
    {
        $admin = $this->request->admin;

        return view('admin.departments.create', compact('admin'));
    }

    public function store()
    {
        try {
            Department::create([
                'title' => $this->request->input('title'),
            ]);
            return redirect(route('admin.departments'))->with('message', trans('trs.changed_successfully'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }

    public function edit(Department $department)
    {
        $admin = $this->request->admin;

        return view('admin.departments.edit', compact('admin', 'department'));
    }

    public function update(Department $department)
    {
        try {
            $department->update([
                'title' => $this->request->input('title'),
            ]);
            return redirect(route('admin.departments'))->with('message', trans('trs.changed_successfully'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }

    public function remove(Department $department)
    {
        try {
            $department->delete();
            return redirect(route('admin.departments'))->with('message', trans('trs.changed_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }
}
