@extends('layouts.front')

@section('content')

    <div class="row m-0">

        @include('front.partials.profile_side_bar')

        <div class="col-12 col-lg-10 p-0">

            <div class="profile_main_wrapper">

                <form action="{{route('profile_update')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="profile_main">
                        <div class="profile_main--link">
                            <ul>
                                <li class="profile_main--link--edit_li">

                                    <div class="input-group">

                                        <input type="text" class="form-control left-to-right" name="linkedin"
                                               value="{{$member->profile->linkedin}}"
                                               placeholder="@lang('trs.linkedin_address')" aria-label="linkedin"
                                               aria-describedby="linkedin">
                                        <span class="input-group-text" id="linkedin"><i
                                                class="fa-brands fa-linkedin"></i></span>

                                    </div>

                                </li>

                                <li class="profile_main--link--edit_li">
                                    <div class="input-group">
                                        <input type="text" class="form-control left-to-right" name="github"
                                               value="{{$member->profile->github}}"
                                               placeholder="@lang('trs.github_address')" aria-label="github"
                                               aria-describedby="github">
                                        <span class="input-group-text" id="github"><i
                                                class="fa-brands fa-github"></i></span>
                                    </div>
                                </li>

                                <li class="profile_main--link--edit_li">
                                    <div class="input-group">
                                        <input name="resume" type="file" accept="application/pdf" class="form-control left-to-right" id="resume">
                                        <label class="input-group-text" for="resume"><i
                                                class="fa-solid fa-file-pdf"></i><span>@lang('trs.resume')</span></label>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        <br class="clear_both">
                        <div class="profile_main_content">

                            <div class="row justify-content-around">
                                <div class="col-12 col-lg-4">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="profile_main--avatar">
                                                <img src="{{$member->profile->avatar}}" title="" alt="">
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="profile_main--name">
                                                <input type="text" class="form-control" name="first_name"
                                                       value="{{$member->profile->first_name}}"
                                                       placeholder="@lang('trs.first_name')">
                                                <input type="text" class="form-control" name="last_name"
                                                       value="{{$member->profile->last_name}}"
                                                       placeholder="@lang('trs.last_name')">
                                            </div>
                                            <div class="profile_main--about">
                                                <p class="about_title">@lang('trs.about')</p>
                                                <textarea name="about" class="about_text form-control"
                                                          placeholder="@lang('trs.about')">{{$member->profile->about}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="profile_main--item">
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="item_title">سمت</p>
                                                <p class="item_value">{{\App\Helper::memberType($member->type)}}</p>
                                                <input type="hidden" name="type" value="{{$member->type}}">
                                            </div>
                                            <div class="col-6">
                                                <p class="item_title"><label
                                                        for="department"> @lang('trs.department')</label></p>

                                                <select name="department" class="form-select" id="department">
                                                    <option>@lang('trs.department')...</option>

                                                    @foreach($departments as $department)
                                                        <option
                                                            value="{{$department->id}}"
                                                            {{$department->id==$member->department->id ? "selected" : ""}}>
                                                            {{$department->title}}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="col-6">
                                                @if ($member->type=="professor")
                                                    <p class="item_title"><label for="rank">@lang('trs.rank')</label>
                                                    </p>
                                                    <select name="rank" class="form-select" id="rank">
                                                        <option>@lang('trs.rank')...</option>

                                                        @foreach($ranks as $rank)
                                                            <option
                                                                value="{{$rank->id}}"
                                                                {{$rank->id==$member->rank->id ? "selected" : ""}}>
                                                                {{$rank->title}}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                @else
                                                    <p class="item_title"><label
                                                            for="degree">@lang('trs.degree')</label>
                                                    </p>

                                                    <select name="degree" class="form-select" id="degree">
                                                        <option>@lang('trs.degree')...</option>

                                                        @foreach($degrees as $degree)
                                                            <option
                                                                value="{{$degree->id}}"
                                                                {{$degree->id==$member->degree->id ? "selected" : ""}}>
                                                                {{$degree->title}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif

                                            </div>
                                            <div class="col-6">
                                                @if ($member->type=="professor")
                                                    <p class="item_title"><label for="group">@lang('trs.group')</label>
                                                    </p>

                                                    <input type="text" class="form-control" name="group" id="group"
                                                           value="{{$member->group}}" placeholder="@lang('trs.group')">
                                                @else
                                                    <p class="item_title"><label
                                                            for="student_number">@lang('trs.student_number')</label></p>

                                                    <input type="text" class="form-control" name="student_number"
                                                           id="student_number"
                                                           value="{{$member->student_number}}"
                                                           placeholder="@lang('trs.student_number')">
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-around">
                                <div class="col-4 text-center">
                                    <button type="submit" class="edit_profile_button">
                                        @lang('trs.submit')
                                    </button>
                                </div>
                            </div>


                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>




@endsection
