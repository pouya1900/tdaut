<div class="col-12">
    <div class="mg-office--item">

        <label>@lang('trs.title')</label>
        <input type="text" name="title" value="{{$product->title}}"
               placeholder="@lang('trs.title')">
    </div>
</div>


<div class="col-12">
    <div class="mg-office--item">
        <label>@lang('trs.description')</label>
        <textarea type="text" name="description"
                  placeholder="@lang('trs.description')">{{$product->description}}</textarea>
    </div>
</div>


<div class="col-12 col-lg-6">
    <div class="mg-office--item">
        <label>@lang('trs.category')</label>
        <select name="category">

            <option>@lang('trs.category')...</option>

            @foreach($categories as $category)
                <option
                    value="{{$category->id}}" {{$product->category_id==$category->id ? "selected" : ""}}>
                    {{$category->title}}
                </option>
            @endforeach

        </select>

    </div>
</div>


<div class="col-12 col-lg-6">
    <div class="mg-office--item">

        <label>@lang('trs.demo_link_optional')</label>
        <input type="text" name="link" value="{{$product->link}}"
               placeholder="@lang('trs.demo_link_optional')">
    </div>
</div>

<div class="col-12">
    <div class="mg-office--item">
        <label>@lang('trs.product_logo')</label>


        <div id="app-image-preview">
            <image-input-preview att_name="logo" src="{{$product->hasLogo ? $product->logo : ""}}">
            </image-input-preview>
        </div>


    </div>
</div>

<div class="col-12">
    <div class="mg-office--item">
        <label>@lang('trs.product_3d_model')</label>


        {{--        <div id="app-td-image-preview">--}}
        {{--            <td-image-input-preview att_name="td" src="{{$product->td}}">--}}
        {{--            </td-image-input-preview>--}}
        {{--        </div>--}}
        <div class="col-6 text-right">
            <input type="file" name="td_model">
        </div>


    </div>
</div>

<div class="col-12">
    <div class="mg-office--item">
        <label>@lang('trs.product_images')</label>


        <div id="app">
            <update-media
                server="{{route('tmp_upload')}}"
                media_file_path="{{$product->imagesPath}}"
                media_server="{{!$office ? route('admin.product.images',['product'=>$product->id]) : route('mg.product_images',['office'=>$office->id,'product'=>$product->id])}}"
                error="@error('media'){{$message}}@enderror">
            </update-media>
        </div>


    </div>
</div>

<div class="col-12">
    <div class="mg-office--item">
        <label>@lang('trs.product_video')</label>


        <div id="app-video-preview">
            <video-input-preview src="{{$product->video}}">
            </video-input-preview>
        </div>


    </div>
</div>


<div class="col-12">
    <div class="mg-office--item">
        <label>@lang('trs.product_catalog')</label>
        <div class="product_catalog--container">

            {{--            @if ($office->catalog)--}}

            <div class="row">
                <div class="col-6 text-right">
                    <input type="file" name="catalog" accept="application/pdf">
                </div>
                <div class="col-6">
                    <div class="product_catalog--exist">
                    <span><i
                            class="fa-solid fa-file-pdf"></i>
                    <a href="{{$product->catalog}}">@lang('trs.download_catalog_submitted_before')</a>
                    </span>

                    </div>
                </div>

            </div>

            {{--            @else--}}
            {{--            @endif--}}
        </div>

    </div>
</div>
