<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRfpRequest;
use App\Models\Category;
use App\Models\Department;
use App\Models\Document;
use App\Models\Message;
use App\Models\Office;
use App\Models\Office_role;
use App\Models\Rfp;
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

        $offices->map(function ($office) {
            $office['url'] = route('office_show', $office->id);
            $office['capabilities'] = $office->capabilities()->limit(3)->get();
            $office['department'] = $office->department;
            $office['head_name'] = $office->head->profile->fullName;
            $office['logo'] = $office->logo;
            $text = '';
            foreach ($office->products as $product) {
                $text .= $product->title . ' , ';
            }
            $office['products_name'] = $text;
            return $office;
        });

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
            $roles_id = Office_role::where('name', $type)->pluck('id')->toArray();
            return $query->wherein('role_id', $roles_id);
        })->distinct()->whereNotNull('email_verified_at')->get();

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
        $categories_id = $categories->pluck('id')->toArray();
        $products = $office->products()
            ->when($category, function ($query) use ($category) {
                return $query->where('category_id', $category->id);
            })->active()->get();

        $products->map(function ($product) {
            $product['url'] = route('product_show', $product->id);
            $product['logo'] = $product->logo;
            $product['office_url'] = route('office_show', $product->office->id);
            $product['office'] = $product->office;
            $product['category'] = $product->category;

            return $product;
        });


        return view('front.offices.products', compact('office', 'products', 'categories', 'categories_id'));

    }

    public function rfp(Office $office)
    {
        return view('front.offices.rfp', compact('office'));
    }

    public function store_rfp(Office $office, StoreRfpRequest $request)
    {

        $rfp = Rfp::create([
            "title"        => $request->input('title'),
            "description"  => $request->input('description'),
            "short_title"  => $request->input('short_title'),
            "goals"        => $request->input('goals'),
            "achievements" => $request->input('achievements'),
            'office_id'    => $office->id,
            'user_id'      => $this->request->current_user->id,
        ]);

        if ($request->hasFile('rfp')) {
            $file = $request->file('rfp');
            Storage::disk("privateStorage")->put('rfp', $file);

            $rfp->media()->create([
                "title"      => $file->hashName(),
                "model_type" => "rfp",
                "ext"        => $file->extension(),
                "size"       => $file->getSize() / 1024,
            ]);
        }

        return redirect(route('user_rfps'));
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
        $user = $this->request->current_user;

        $message = $this->request->input('message');

        $user->messages()->create([
            'office_id' => $office->id,
            'sender'    => 'user',
            'text'      => $message,
        ]);

        return redirect(route('office_chat', ['office' => $office->id]));
    }

    public function search()
    {
        $string = $this->request->input('str');

        $offices = Office::where('name', 'like', "%$string%")->get();

        $response = [];

        foreach ($offices as $office) {
            $response[] = [
                'name' => $office->name,
                'id'   => $office->id,
                'logo' => $office->logo,
            ];
        }
        return json_encode($response);
    }


}
