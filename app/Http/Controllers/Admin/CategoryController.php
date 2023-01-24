<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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

        $categories = Category::all();

        foreach ($categories as $category) {
            $data[] = [
                'title'       => $category->title,
                'description' => $category->description,
                'action'      => view('front.partials.action', ['edit' => route('admin.category.edit', ['category' => $category->id]), 'remove' => route('admin.category.remove', ['category' => $category->id])])->render(),
            ];
        }

        return view('admin.categories.index', compact('admin', 'data'));

    }

    public function create()
    {
        $admin = $this->request->admin;

        return view('admin.categories.create', compact('admin'));
    }

    public function store()
    {
        try {
            Category::create([
                'title'       => $this->request->input('title'),
                'description' => $this->request->input('description'),
            ]);
            return redirect(route('admin.categories'))->with('message', trans('trs.changed_successfully'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }

    public function edit(Category $category)
    {
        $admin = $this->request->admin;

        return view('admin.categories.edit', compact('admin', 'category'));
    }

    public function update(Category $category)
    {
        try {
            $category->update([
                'title'       => $this->request->input('title'),
                'description' => $this->request->input('description'),
            ]);
            return redirect(route('admin.categories'))->with('message', trans('trs.changed_successfully'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }

    public function remove(Category $category)
    {
        try {
            $category->delete();
            return redirect(route('admin.categories'))->with('message', trans('trs.changed_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }
}
