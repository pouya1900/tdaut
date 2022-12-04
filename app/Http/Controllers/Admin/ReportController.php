<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Office;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
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

        $reports = Report::all();

        foreach ($reports as $report) {
            if (!$report->reportable || !$report->type) {
                continue;
            }
            if ($report->reportable instanceof Office) {
                $name = $report->reportable->name;
                $link = route('office_show', $report->reportable->id);
            } else {
                $name = $report->reportable->title;
                $link = route('product_show', $report->reportable->id);
            }

            $data[] = [
                'model'  => $report->reportable->modelName,
                'name'   => $name,
                'type'   => $report->type->title,
                'text'   => $report->text,
                'action' => view('front.partials.action', ['show' => $link, 'blank' => true])->render(),
            ];
        }
        return view('admin.reports.index', compact('admin', 'data'));

    }
}
