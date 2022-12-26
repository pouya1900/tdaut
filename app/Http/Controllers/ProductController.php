<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(Request $request, Product $product)
    {
        $this->request = $request;
        $this->product = $product;
    }

    public function show(Product $product)
    {
        $office = $product->office;
        return view('front.products.show', compact('product', 'office'));
    }

}
