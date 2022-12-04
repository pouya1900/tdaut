@extends('layouts.front')

@section('content')

    <div class="row m-0">

        @include('front.partials.user_side_bar')

        <div class="col-12 col-lg-10 p-0">

            <div class="profile_main_wrapper">
                <div class="profile_main">
                    <form action="{{route('user_update')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="profile_main">
                            <div class="profile_main--link">
                                <ul>
                                    <li class="profile_main--link--edit_li">
                                        <div class="input-group">
                                            <input type="text" class="form-control left-to-right" name="linkedin"
                                                   value="{{$user->profile->linkedin}}"
                                                   placeholder="@lang('trs.linkedin_address')" aria-label="linkedin"
                                                   aria-describedby="linkedin">
                                            <span class="input-group-text" id="linkedin"><i
                                                    class="fa-brands fa-linkedin"></i></span>
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
                                                    <img src="{{$user->profile->avatar}}" title="" alt="">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="profile_main--name">
                                                    <input type="text" class="form-control" name="first_name"
                                                           value="{{$user->profile->first_name}}"
                                                           placeholder="@lang('trs.first_name')">
                                                    <input type="text" class="form-control" name="last_name"
                                                           value="{{$user->profile->last_name}}"
                                                           placeholder="@lang('trs.last_name')">
                                                </div>
                                                <div class="profile_main--about">
                                                    <p class="about_title">@lang('trs.about')</p>
                                                    <textarea name="about" class="about_text form-control"
                                                              placeholder="@lang('trs.about')">{{$user->profile->about}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="profile_main--item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p class="item_title">نوع</p>
                                                    <p class="item_value">{{\App\Helper::userType($user->type)}}</p>
                                                    <input type="hidden" name="type" value="{{$user->type}}">
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

    </div>




@endsection
