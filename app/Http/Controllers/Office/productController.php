<?php

namespace App\Http\Controllers\Office;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Office;
use App\Models\Product;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function __construct(Request $request, Office $office)
    {
        $this->request = $request;
        $this->office = $office;
    }

    public function index(Office $office)
    {
        $data = [];
        foreach ($office->products as $product) {
            $data[] = [
                'title'          => $product->title,
                'category'       => $product->category->title,
                'status'         => Helper::productStatusTotranslated($product->status),
                'status_message' => $product->status_message,
                'status_date'    => $product->status_date,
                'link'           => $product->link,
                'created_at'     => date('Y-m-d H:i', strtotime($product->created_at)),
                'action'         => view('office.includes.action', ['edit' => route('mg.product_edit', ['office' => $office->id, 'product' => $product->id]), 'remove' => route('mg.product_remove', ['office' => $office->id, 'product' => $product->id])])->render(),
            ];
        }

        return view('office.products.index', compact('office', 'data'));

    }

    public function create(Office $office)
    {
        $categories = Category::all();

        return view('office.products.create', compact('office', 'categories'));

    }

    public function store(StoreProductRequest $request, Office $office)
    {
        $product = $office->products()->create([
            'title'       => $request->input('title'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category'),
            'link'        => $request->input('link'),
        ]);

        return redirect(route('mg.product_edit', ['office' => $office->id, 'product' => $product->id]));

    }

    public function edit(Office $office, Product $product)
    {
        $categories = Category::all();

        return view('office.products.edit', compact('office', 'product', 'categories'));
    }

    public function update(Office $office, Product $product)
    {
    }

    public function remove(Office $office, Product $product)
    {

    }

}
