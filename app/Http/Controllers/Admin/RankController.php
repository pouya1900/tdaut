<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Rank;
use Illuminate\Http\Request;

class RankController extends Controller
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

        $ranks = Rank::all();

        foreach ($ranks as $rank) {
            $data[] = [
                'title'  => $rank->title,
                'action' => view('front.partials.action', ['edit' => route('admin.rank.edit', ['rank' => $rank->id]), 'remove' => route('admin.rank.remove', ['rank' => $rank->id])])->render(),
            ];
        }

        return view('admin.ranks.index', compact('admin', 'data'));

    }

    public function create()
    {
        $admin = $this->request->admin;

        return view('admin.ranks.create', compact('admin'));
    }

    public function store()
    {
        try {
            Rank::create([
                'title' => $this->request->input('title'),
            ]);
            return redirect(route('admin.ranks'))->with('message', trans('trs.changed_successfully'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }

    public function edit(Rank $rank)
    {
        $admin = $this->request->admin;

        return view('admin.ranks.edit', compact('admin', 'rank'));
    }

    public function update(Rank $rank)
    {
        try {
            $rank->update([
                'title' => $this->request->input('title'),
            ]);
            return redirect(route('admin.ranks'))->with('message', trans('trs.changed_successfully'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }

    public function remove(Rank $rank)
    {
        try {
            $rank->delete();
            return redirect(route('admin.ranks'))->with('message', trans('trs.changed_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }
}
