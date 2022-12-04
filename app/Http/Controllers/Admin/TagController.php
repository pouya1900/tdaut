<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
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

        $tags = Tag::all();

        foreach ($tags as $tag) {
            $data[] = [
                'title'  => $tag->title,
                'action' => view('front.partials.action', ['edit' => route('admin.tag.edit', ['tag' => $tag->id]), 'remove' => route('admin.tag.remove', ['tag' => $tag->id])])->render(),
            ];
        }

        return view('admin.tags.index', compact('admin', 'data'));

    }

    public function create()
    {
        $admin = $this->request->admin;

        return view('admin.tags.create', compact('admin'));
    }

    public function store()
    {
        try {
            Tag::create([
                'title' => $this->request->input('title'),
            ]);
            return redirect(route('admin.tags'))->with('message', trans('trs.changed_successfully'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }

    public function edit(Tag $tag)
    {
        $admin = $this->request->admin;

        return view('admin.tags.edit', compact('admin', 'tag'));
    }

    public function update(Tag $tag)
    {
        try {
            $tag->update([
                'title' => $this->request->input('title'),
            ]);
            return redirect(route('admin.tags'))->with('message', trans('trs.changed_successfully'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }

    public function remove(Tag $tag)
    {
        try {
            $tag->delete();
            return redirect(route('admin.tags'))->with('message', trans('trs.changed_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }
}
