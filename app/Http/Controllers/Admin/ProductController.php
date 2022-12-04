<?php

namespace App\Http\Controllers\Admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Administrator;
use App\Models\Category;
use App\Models\Media;
use App\Models\Office;
use App\Models\Product;
use App\Traits\UploadUtilsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use UploadUtilsTrait;

    public function __construct(Request $request, Administrator $admin)
    {
        $this->request = $request;
        $this->admin = $admin;
    }

    public function index(Office $office = null)
    {
        $admin = $this->request->admin;

        $filter = $this->request->filter;

        $data = [];
        if ($office) {
            $products = $office->products()->when($filter, function ($q) use ($filter) {
                return $q->where('status', $filter);
            })->get();
        } else {
            $products = Product::when($filter, function ($q) use ($filter) {
                return $q->where('status', $filter);
            })->get();
        }

        foreach ($products as $product) {
            $data[] = [
                'title'          => $product->title,
                'office'         => $product->office->name,
                'category'       => $product->category->title,
                'status'         => Helper::productStatusToTranslated($product->status),
                'status_message' => $product->status_message,
                'status_date'    => date('Y-m-d', strtotime($product->status_date)),
                'link'           => $product->link,
                'created_at'     => date('Y-m-d H:i', strtotime($product->created_at)),
                'action'         => view('front.partials.action', ['edit' => route('admin.product.edit', ['product' => $product->id]), 'remove' => route('admin.product.remove', ['product' => $product->id])])->render(),
            ];
        }

        return view('admin.products.index', compact('admin', 'data', 'office', 'filter'));

    }

    public function edit(Product $product)
    {
        $admin = $this->request->admin;

        $statuses = ['accepted', 'rejected', 'pending', 'rfd'];

        $categories = Category::all();
        return view('admin.products.edit', compact('admin', 'product', 'categories', 'statuses'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $added_media = $request->input('added_media');
            $deleted_media = $request->input('deleted_media');

            $status_date = $product->status_date;
            if ($product->status != $request->input('status')) {
                $status_date = date('Y-m-d H:i', strtotime('now'));
            }

            $product->update([
                'title'          => $request->input('title'),
                'description'    => $request->input('description'),
                'category_id'    => $request->input('category'),
                'link'           => $request->input('link'),
                'status'         => $request->input('status'),
                'status_message' => $request->input('status_message'),
                'status_date'    => $status_date,
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
            return redirect(route('admin.products'))->with('message', trans('trs.changed_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }

    }

    public function remove(Product $product)
    {
        $product->delete();
        return redirect(route('admin.products'))->with('message', trans('trs.remove_product_success'));
    }

    public function images(Product $product)
    {
        $media = $product->imagesName;

        return ['media' => $media];
    }

}
