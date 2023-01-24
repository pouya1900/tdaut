@extends('layouts.admin')

@section('content')

    @include('front.partials.error_message')
    <form action="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row">
            <div class="col-6">
                <div class="mg-office--item">

                    <label>@lang('trs.site_title')</label>
                    <input type="text" name="title" value="{{$setting->title}}"
                           placeholder="@lang('trs.site_title')">
                </div>
            </div>
            <div class="col-6">
                <div class="mg-office--item">

                    <label>@lang('trs.email')</label>
                    <input type="text" name="email" value="{{$setting->email}}"
                           placeholder="@lang('trs.email')">
                </div>
            </div>
            <div class="col-6">
                <div class="mg-office--item">

                    <label>@lang('trs.phone')</label>
                    <input type="text" name="phone" value="{{$setting->phone}}"
                           placeholder="@lang('trs.phone')">
                </div>
            </div>
            <div class="col-6">
                <div class="mg-office--item">

                    <label>@lang('trs.address')</label>
                    <input type="text" name="address" value="{{$setting->address}}"
                           placeholder="@lang('trs.address')">
                </div>
            </div>
            <div class="col-12">
                <div class="mg-office--item">
                    <label>@lang('trs.site_logo')</label>
                    <div id="app-image-preview">
                        <image-input-preview att_name="logo" src="{{$setting->logo}}">
                        </image-input-preview>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="mg-office--item">
                    <label>@lang('trs.site_icon')</label>
                    <div id="app-image-preview2">
                        <image-input-preview att_name="icon" src="{{$setting->icon}}">
                        </image-input-preview>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="mg-office--item">
                    <label>@lang('trs.background_video')</label>


                    <div id="app-video-preview">
                        <video-input-preview src="{{$setting->backgroundVideo}}">
                        </video-input-preview>
                    </div>


                </div>
            </div>

            <div class="col-12">
                <div class="mg-office--item">
                    <label>@lang('trs.background_image')</label>
                    <div id="app-image-preview3">
                        <image-input-preview att_name="background_image" src="{{$setting->backgroundImage}}">
                        </image-input-preview>
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
@endsection
