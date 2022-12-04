<?php

namespace App\Http\Controllers\Office;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Media;
use App\Models\Office;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Traits\UploadUtilsTrait;

class productController extends Controller
{
    use UploadUtilsTrait;

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
                'status'         => Helper::productStatusToTranslated($product->status),
                'status_message' => $product->status_message,
                'status_date'    => $product->status_date,
                'link'           => $product->link,
                'created_at'     => date('Y-m-d H:i', strtotime($product->created_at)),
                'action'         => view('front.partials.action', ['edit' => route('mg.product_edit', ['office' => $office->id, 'product' => $product->id]), 'remove' => route('mg.product_remove', ['office' => $office->id, 'product' => $product->id])])->render(),
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
        if ($product->office->id != $office->id) {
            abort(403);
        }
        $categories = Category::all();

        return view('office.products.edit', compact('office', 'product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Office $office, Product $product)
    {
        if ($product->office->id != $office->id) {
            abort(403);
        }

        $added_media = $request->input('added_media');
        $deleted_media = $request->input('deleted_media');

        $product->update([
            'title'       => $request->input('title'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category'),
            'link'        => $request->input('link'),
        ]);

        if ($added_media) {
            foreach ($added_media as $media_name) {
                $file = Storage::disk('privateStorage')->readStream('tmp/' . $media_name);
                Storage::disk('assetsStorage')->writeStream('productImage/' . $media_name, $file);
                Storage::disk('privateStorage')->delete('tmp/' . $media_name);

                $media = Media::where('title', $media_name)->first();

                $product->media()->save($media);
                $media->update(['model_type' => 'productImage']);
            }
        }

        if ($deleted_media) {
            foreach ($deleted_media as $deleted_name) {
                Storage::disk('assetsStorage')->delete('productImage/' . $deleted_name);

                $media = Media::where('title', $deleted_name)->first();

                $media->delete();
            }
        }

        if ($request->input('deleted_image_logo')) {
            $logo = $product->logoModel;
            if ($logo) {
                $this->mediaRemove($logo, 'assetsStorage');
            }
        }
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $this->imageUpload($logo, 'productLogo', 'assetsStorage', $product);
        }

        if ($request->input('deleted_image_td')) {
            $td = $product->tdModel;
            if ($td) {
                $this->mediaRemove($td, 'assetsStorage');
            }
        }
        if ($request->hasFile('td')) {
            $td = $request->file('td');
            $this->imageUpload($td, 'productTd', 'assetsStorage', $product);
        }


        if ($request->input('deleted_video')) {
            $video = $product->videoModel;
            if ($video) {
                $this->mediaRemove($video, 'assetsStorage');
            }
        }

        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $this->videoUpload($video, $product, 'productVideo', 'assetsStorage');
        }

        return redirect(route('mg.products', $office->id));

    }

    public function remove(Office $office, Product $product)
    {
        if ($product->office->id != $office->id) {
            abort(403);
        }
        $product->delete();
        return redirect(route('mg.products', $office->id))->with('message', trans('trs.remove_product_success'));
    }

    public function images(Office $office, Product $product)
    {
        if ($product->office->id != $office->id) {
            abort(403);
        }
        $media = $product->imagesName;

        return ['media' => $media];
    }


}
