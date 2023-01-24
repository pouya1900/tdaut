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
    <form action="{{route('admin.user.update',['user'=>$user->id])}}"
          method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @include('front.partials.error_message')
        <div class="row m-0">
            <div class="col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.first_name')</label>
                    <input type="text" name="first_name" value="{{$user->profile->first_name}}"
                           placeholder="@lang('trs.first_name')">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.last_name')</label>
                    <input type="text" name="last_name" value="{{$user->profile->last_name}}"
                           placeholder="@lang('trs.last_name')">
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.email')</label>
                    <input type="text" name="email" value="{{$user->email}}"
                           placeholder="@lang('trs.email')">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.username')</label>
                    <input type="text" name="username" value="{{$user->profile->username}}"
                           placeholder="@lang('trs.username')">
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.about')</label>
                    <textarea type="text" name="description"
                              placeholder="@lang('trs.about')">{{$user->about}}</textarea>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="mg-office--item">
                    <div class="form-check form-check-inline">
                        <label>@lang('trs.male')</label>
                        <input type="radio" name="gender" value="male" {{$user->profile->gender=='male' ? 'checked' : ""}}>
                    </div>
                    <div class="form-check form-check-inline">
                        <label>@lang('trs.female')</label>
                        <input type="radio" name="gender"
                               value="female" {{$user->profile->gender=='female' ? 'checked' : ""}}>
                    </div>
                </div>
            </div>


            <div class="col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.linkedin')</label>
                    <input type="text" name="linkedin" value="{{$user->profile->linkedin}}"
                           placeholder="@lang('trs.linkedin')">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.github')</label>
                    <input type="text" name="github" value="{{$user->profile->github}}"
                           placeholder="@lang('trs.github')">
                </div>
            </div>

            <div class=" col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.role')</label>
                    <select name="role">

                        <option>@lang('trs.role')...</option>

                        @foreach($roles as $role)
                            <option
                                value="{{$role->id}}" {{$user->role==$role ? "selected" : ""}}>
                                {{$role->title}}
                            </option>
                        @endforeach

                    </select>

                </div>
            </div>

            <div class=" col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.type')</label>
                    <select name="type">

                        <option>@lang('trs.type')...</option>

                        @foreach($types as $type)
                            <option
                                value="{{$type}}" {{$user->type==$type ? "selected" : ""}}>
                                {{\App\Helper::userType($type)}}
                            </option>
                        @endforeach

                    </select>

                </div>
            </div>


            <div class="col-12">
                <div class="mg-office--item">
                    <label>@lang('trs.avatar')</label>


                    <div id="app-image-preview">
                        <image-input-preview att_name="image" src="{{$user->profile->hasAvatar ? $user->profile->avatar : ""}}">
                        </image-input-preview>
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
                                value="{{$status}}" {{$status==$user->status? "selected" : ""}}>
                                {{\App\Helper::userStatusToTranslated($status)}}
                            </option>
                        @endforeach

                    </select>


                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.status_message')</label>
                    <textarea type="text" name="status_message"
                              placeholder="@lang('trs.status_message')">{{$user->status_message}}</textarea>
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
