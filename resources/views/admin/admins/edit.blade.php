@extends('layouts.admin')

@section('style')

@endsection

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
    <form action="{{route('admin.admin.update',['administrator'=>$administrator->id])}}"
          method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @include('front.partials.error_message')
        <div class="row m-0">
            <div class="col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.first_name')</label>
                    <input type="text" name="first_name" value="{{$administrator->profile->first_name}}"
                           placeholder="@lang('trs.first_name')">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.last_name')</label>
                    <input type="text" name="last_name" value="{{$administrator->profile->last_name}}"
                           placeholder="@lang('trs.last_name')">
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.email')</label>
                    <input type="text" name="email" value="{{$administrator->email}}"
                           placeholder="@lang('trs.email')">
                </div>
            </div>

            <div class=" col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.role')</label>
                    <select name="role">

                        <option>@lang('trs.role')...</option>

                        @foreach($roles as $role)
                            <option
                                value="{{$role->id}}" {{$administrator->role==$role ? "selected" : ""}}>
                                {{$role->title}}
                            </option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="col-12">
                <div class="mg-office--item">
                    <label>@lang('trs.avatar')</label>


                    <div id="app-image-preview">
                        <image-input-preview att_name="image"
                                             src="{{$administrator->profile->hasAvatar ? $administrator->profile->avatar : ""}}">
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

@section('script')

@endsection
