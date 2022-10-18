<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRfpRequest;
use App\Models\Category;
use App\Models\Department;
use App\Models\Document;
use App\Models\Message;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfficeController extends Controller
{

    public function __construct(Request $request, Office $office)
    {
        $this->request = $request;
        $this->office = $office;
    }

    /**
     *main page of offices
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $offices = $this->office->active()->get();

        $departments = Department::all();

        return view('front.offices.index', compact('offices', 'departments'));
    }

    /**
     * show office
     *
     * @param Office $office
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Office $office)
    {
        return view('front.offices.show', compact('office'));
    }

    /**
     * show office members
     *
     * @param Office $office
     * @param string $type
     * @return \Illuminate\Contracts\View\View
     */
    public function members(Office $office, string $type = null)
    {

        $members = $office->members()->
        when($type, function ($query) use ($type) {
            return $query->whereHas('roles', function ($query) use ($type) {
                return $query->where('name', $type);
            });
        })->distinct()->get();

        return view('front.offices.members', compact('office', 'members'));
    }

    /**
     * show office products
     *
     * @param Office $office
     * @param Category $category
     * @return \Illuminate\Contracts\View\View
     */
    public function products(Office $office, Category $category = null)
    {
        $categories = Category::all();
        $products = $office->products()
            ->when($category, function ($query) use ($category) {
                return $query->where('category_id', $category->id);
            })->active()->get();


        return view('front.offices.products', compact('office', 'products', 'categories'));

    }

    public function rfp(Office $office)
    {
        return view('front.offices.rfp', compact('office'));
    }

    public function store_rfp(Office $office, StoreRfpRequest $request)
    {

        $document = Document::create([
            "title"       => $request->input('title'),
            "description" => $request->input('description'),
            'office_id'   => $office->id,
            'user_id'     => $this->request->current_user->id,
            'type'        => 'rfp',
        ]);

        if ($request->hasFile('rfp')) {
            $file = $request->file('rfp');
            Storage::disk("privateStorage")->put('rfp', $file);

            $document->media()->create([
                "title"      => $file->hashName(),
                "model_type" => "rfp",
                "ext"        => $file->extension(),
                "size"       => $file->getSize() / 1024,
            ]);
        }
    }

    public function contact(Office $office)
    {
        return view('front.offices.contact', compact('office'));
    }

    public function chat(Office $office)
    {
        $messages = $office->messages()->where('user_id', $this->request->current_user->id)->get();

        return view('front.offices.chat', compact('messages', 'office'));
    }

    public function store_chat(Office $office)
    {

    }

}
