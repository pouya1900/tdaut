@extends('layouts.admin')

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
    <div class="my-table">
        @include('front.partials.error_message')

        <form action="{{route('admin.office.update',$office->id)}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$office->id}}">
            <div class="row m-0">
                <div class="col-12 col-lg-6">
                    <div class="mg-office--item">

                        <label>@lang('trs.name')</label>
                        <input type="text" name="name" value="{{$office->name}}"
                               placeholder="@lang('trs.name')">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="mg-office--item">
                        <label>@lang('trs.email')</label>
                        <input type="text" name="email" value="{{$office->email}}"
                               placeholder="@lang('trs.email')">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="mg-office--item">
                        <label>@lang('trs.phone')</label>
                        <input type="text" name="phone" value="{{$office->phone}}"
                               placeholder="@lang('trs.phone')">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="mg-office--item">
                        <label>@lang('trs.address')</label>
                        <input type="text" name="address" value="{{$office->address}}"
                               placeholder="@lang('trs.address')">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="mg-office--item">
                        <label>@lang('trs.admin_contact')</label>
                        <input type="text" name="admin_contact" value="{{$office->admin_contact}}"
                               placeholder="@lang('trs.admin_contact')">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="mg-office--item">
                        <label>@lang('trs.projects_count')</label>
                        <input type="number" name="projects_count" value="{{$office->projects_count}}"
                               placeholder="@lang('trs.projects_count')">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="mg-office--item">
                        <label>@lang('trs.department')</label>
                        <select name="department">

                            <option>@lang('trs.department')...</option>

                            @foreach($departments as $department)
                                <option
                                    value="{{$department->id}}" {{$department->id==$office->department->id ? "selected" : ""}}>
                                    {{$department->title}}
                                </option>
                            @endforeach

                        </select>


                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="mg-office--item">
                        <label>@lang('trs.about')</label>
                        <textarea type="text" name="about"
                                  placeholder="@lang('trs.about')">{{$office->about}}</textarea>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mg-office--item">
                        <label>@lang('trs.office_logo')</label>


                        <div id="app-image-preview">
                            <image-input-preview att_name="image" src="{{$office->hasLogo ? $office->logo : ""}}">
                            </image-input-preview>
                        </div>


                    </div>
                </div>

                <div class="col-12">
                    <div class="mg-office--item">
                        <label>@lang('trs.office_slide_show_image')</label>


                        <div id="app">
                            <update-media
                                server="{{route('tmp_upload')}}"
                                media_file_path="{{$office->SlideshowPath}}"
                                media_server="{{route('admin.office.slideshow_images',['office'=>$office->id])}}"
                                error="@error('media'){{$message}}@enderror">
                            </update-media>
                        </div>


                    </div>
                </div>

                <div class="col-12">
                    <div class="mg-office--item">
                        <label>@lang('trs.head_introduction_video')</label>

                        <div id="app-video-preview">
                            <video-input-preview src="{{$office->headIntroduction}}">
                            </video-input-preview>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="mg-office--item">
                        <label>@lang('trs.status')</label>
                        <select name="status">

                            <option>@lang('trs.status')...</option>

                            @foreach($statuses as $status)
                                <option
                                    value="{{$status}}" {{$status==$office->status? "selected" : ""}}>
                                    {{\App\Helper::officeStatusToTranslated($status)}}
                                </option>
                            @endforeach

                        </select>


                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="mg-office--item">
                        <label>@lang('trs.status_message')</label>
                        <textarea type="text" name="status_message"
                                  placeholder="@lang('trs.status_message')">{{$office->status_message}}</textarea>
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
@endsection
