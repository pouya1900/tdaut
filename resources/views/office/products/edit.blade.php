@extends('layouts.office_panel')

@section('content')
    <style>
        .close-btn[data-v-3904557e] {
            left: 34px !important;
            right: unset !important;
        }

        .custum-icon[data-v-3904557e] {
            margin-left: unset !important;
        }
    </style>
    <div class="row m-0 full-height">

        @include('office.includes.side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="mg-office-dashboard">
                <form action="{{route('mg.product_update',['office'=>$office->id,'product'=>$product->id])}}"
                      method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @include('front.partials.error_message')
                    <div class="row m-0">
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

                                <label>@lang('trs.demo_link')</label>
                                <input type="text" name="link" value="{{$product->link}}"
                                       placeholder="@lang('trs.demo_link')">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mg-office--item">
                                <label>@lang('trs.product_logo')</label>


                                <div id="app-image-preview">
                                    <image-input-preview  att_name="logo" src="{{$product->hasLogo ? $product->logo : ""}}">
                                    </image-input-preview>
                                </div>


                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mg-office--item">
                                <label>@lang('trs.product_3d_picture')</label>


                                <div id="app-td-image-preview">
                                    <td-image-input-preview att_name="td" src="{{$product->td}}">
                                    </td-image-input-preview>
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
                                        media_server="{{route('mg.product_images',['office'=>$office->id,'product'=>$product->id])}}"
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


                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4 text-center">
                            <button type="submit" class="edit_profile_button">
                                @lang('trs.submit')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
