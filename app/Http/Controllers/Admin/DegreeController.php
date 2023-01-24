<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Category;
use App\Models\Degree;
use Illuminate\Http\Request;

class DegreeController extends Controller
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

        $degrees= Degree::all();

        foreach ($degrees as $degree) {
            $data[] = [
                'title'       => $degree->title,
                'action'      => view('front.partials.action', ['edit' => route('admin.degree.edit', ['degree' => $degree->id]), 'remove' => route('admin.degree.remove', ['degree' => $degree->id])])->render(),
            ];
        }

        return view('admin.degrees.index', compact('admin', 'data'));

    }

    public function create()
    {
        $admin = $this->request->admin;

        return view('admin.degrees.create', compact('admin'));
    }

    public function store()
    {
        try {
            Degree::create([
                'title'       => $this->request->input('title'),
            ]);
            return redirect(route('admin.degrees'))->with('message', trans('trs.changed_successfully'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }

    public function edit(Degree $degree)
    {
        $admin = $this->request->admin;

        return view('admin.degrees.edit', compact('admin', 'degree'));
    }

    public function update(Degree $degree)
    {
        try {
            $degree->update([
                'title'       => $this->request->input('title'),
            ]);
            return redirect(route('admin.degrees'))->with('message', trans('trs.changed_successfully'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }

    public function remove(Degree $degree)
    {
        try {
            $degree->delete();
            return redirect(route('admin.degrees'))->with('message', trans('trs.changed_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }
}
