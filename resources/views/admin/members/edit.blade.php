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
    <form action="{{route('admin.member.update',['member'=>$member->id])}}"
          method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @include('front.partials.error_message')
        <div class="row m-0">
            <div class="col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.first_name')</label>
                    <input type="text" name="first_name" value="{{$member->profile->first_name}}"
                           placeholder="@lang('trs.first_name')">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.last_name')</label>
                    <input type="text" name="last_name" value="{{$member->profile->last_name}}"
                           placeholder="@lang('trs.last_name')">
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.email')</label>
                    <input type="text" name="email" value="{{$member->email}}"
                           placeholder="@lang('trs.email')">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.username')</label>
                    <input type="text" name="username" value="{{$member->profile->username}}"
                           placeholder="@lang('trs.username')">
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.about')</label>
                    <textarea type="text" name="description"
                              placeholder="@lang('trs.about')">{{$member->about}}</textarea>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="mg-office--item">
                    <div class="form-check form-check-inline">
                        <label>@lang('trs.male')</label>
                        <input type="radio" name="gender"
                               value="male" {{$member->profile->gender=='male' ? 'checked' : ""}}>
                    </div>
                    <div class="form-check form-check-inline">
                        <label>@lang('trs.female')</label>
                        <input type="radio" name="gender"
                               value="female" {{$member->profile->gender=='female' ? 'checked' : ""}}>
                    </div>
                </div>
            </div>


            <div class="col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.linkedin')</label>
                    <input type="text" name="linkedin" value="{{$member->profile->linkedin}}"
                           placeholder="@lang('trs.linkedin')">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.github')</label>
                    <input type="text" name="github" value="{{$member->profile->github}}"
                           placeholder="@lang('trs.github')">
                </div>
            </div>

            @if ($member->type=="professor")
                <div class=" col-12 col-lg-6">
                    <div class="mg-office--item">
                        <label>@lang('trs.rank')</label>
                        <select name="rank">

                            <option>@lang('trs.rank')...</option>

                            @foreach($ranks as $rank)
                                <option
                                    value="{{$rank->id}}" {{$member->rank->id==$rank->id ? "selected" : ""}}>
                                    {{$rank->title}}
                                </option>
                            @endforeach

                        </select>

                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="mg-office--item">
                        <label>@lang('trs.group')</label>
                        <input type="text" name="group" value="{{$member->group}}"
                               placeholder="@lang('trs.group')">
                    </div>
                </div>

            @endif

            @if ($member->type=="professor" || $member->type=="student")
                <div class=" col-12 col-lg-6">
                    <div class="mg-office--item">
                        <label>@lang('trs.department')</label>
                        <select name="rank">

                            <option>@lang('trs.department')...</option>

                            @foreach($departments as $department)
                                <option
                                    value="{{$department->id}}" {{$member->department->id==$department->id ? "selected" : ""}}>
                                    {{$department->title}}
                                </option>
                            @endforeach

                        </select>

                    </div>
                </div>

            @endif

            @if ($member->type=="staff" || $member->type=="student")
                <div class=" col-12 col-lg-6">
                    <div class="mg-office--item">
                        <label>@lang('trs.degree')</label>
                        <select name="rank">

                            <option>@lang('trs.degree')...</option>

                            @foreach($degrees as $degree)
                                <option
                                    value="{{$degree->id}}" {{$member->degree->id==$degree->id ? "selected" : ""}}>
                                    {{$degree->title}}
                                </option>
                            @endforeach

                        </select>

                    </div>
                </div>

            @endif

            @if ($member->type=="student")
                <div class="col-12 col-lg-6">
                    <div class="mg-office--item">
                        <label>@lang('trs.student_number')</label>
                        <input type="text" name="student_number" value="{{$member->student_number}}"
                               placeholder="@lang('trs.student_number')">
                    </div>
                </div>

            @endif


            <div class="col-12">
                <div class="mg-office--item">
                    <label>@lang('trs.avatar')</label>


                    <div id="app-image-preview">
                        <image-input-preview att_name="image" src="{{$member->profile->hasAvatar ? $member->profile->avatar : ""}}">
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
