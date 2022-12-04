<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Report_type;
use Illuminate\Http\Request;

class ReportTypeController extends Controller
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

        $report_types = Report_type::all();

        foreach ($report_types as $report_type) {
            $data[] = [
                'title'       => $report_type->title,
                'description' => $report_type->description,
                'action'      => view('front.partials.action', ['edit' => route('admin.reports.type.edit', ['report_type' => $report_type->id]), 'remove' => route('admin.reports.type.remove', ['report_type' => $report_type->id])])->render(),
            ];
        }

        return view('admin.report_types.index', compact('admin', 'data'));

    }

    public function create()
    {
        $admin = $this->request->admin;

        return view('admin.report_types.create', compact('admin'));
    }

    public function store()
    {
        try {
            Report_type::create([
                'title'       => $this->request->input('title'),
                'description' => $this->request->input('description'),
            ]);
            return redirect(route('admin.reports.types'))->with('message', trans('trs.changed_successfully'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }

    public function edit(Report_type $report_type)
    {
        $admin = $this->request->admin;

        return view('admin.report_types.edit', compact('admin', 'report_type'));
    }

    public function update(Report_type $report_type)
    {
        try {
            $report_type->update([
                'title'       => $this->request->input('title'),
                'description' => $this->request->input('description'),
            ]);
            return redirect(route('admin.reports.types'))->with('message', trans('trs.changed_successfully'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }

    public function remove(Report_type $report_type)
    {
        try {
            $report_type->delete();
            return redirect(route('admin.reports.types'))->with('message', trans('trs.changed_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }
}
