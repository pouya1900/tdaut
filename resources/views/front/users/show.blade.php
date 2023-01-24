@extends('layouts.front')

@section('content')

    <div class="row m-0">

        @include('front.partials.user_side_bar')

        <div class="col-12 col-lg-10 p-0">

            <div class="profile_main_wrapper">

                <div class="profile_main">
                    <div class="profile_main--link">
                        <ul>
                            @if ($user->profile->linkedin)
                                <li>
                                    <a href="{{$user->profile->linkedin}}"><i class="fa-brands fa-linkedin"></i></a>
                                </li>
                            @endif

                        </ul>
                    </div>
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
                                            <p>{{$user->profile->fullName}}</p>
                                        </div>
                                        <div class="profile_main--about">
                                            <p class="about_title">@lang('trs.about')</p>
                                            <p class="about_text">{{$user->profile->about}}</p>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($current_user && $current_user->id==$user->id)
                            <div class="row justify-content-around">
                                <div class="col-4 text-center">
                                    <a href="{{route('user_edit')}}" class="edit_profile_button">
                                        ویرایش پروفایل
                                    </a>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

            </div>

        </div>

    </div>




@endsection
