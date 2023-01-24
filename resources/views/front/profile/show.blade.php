@extends('layouts.front')

@section('content')

    <div class="row m-0">

        @include('front.partials.profile_side_bar')

        <div class="col-12 col-lg-10 p-0">

            <div class="profile_main_wrapper">

                <div class="profile_main">
                    <div class="profile_main--link">
                        <ul>
                            @if ($member->profile->linkedin)
                                <li>
                                    <a href="{{$member->profile->linkedin}}"><i class="fa-brands fa-linkedin"></i></a>
                                </li>
                            @endif
                            @if ($member->profile->github)

                                <li>
                                    <a target="_blank" href="{{$member->profile->github}}"><i
                                            class="fa-brands fa-github"></i></a>
                                </li>
                            @endif
                            @if ($member->profile->cv)

                                <li>
                                    <a target="_blank" href="{{$member->profile->cv}}"><i
                                            class="fa-solid fa-file-pdf"></i><span>@lang('trs.resume')</span></a>
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
                                            <img src="{{$member->profile->avatar}}" title="" alt="">
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="profile_main--name">
                                            <p>{{$member->profile->fullName}}</p>
                                        </div>
                                        <div class="profile_main--about">
                                            <p class="about_title">@lang('trs.about')</p>
                                            <p class="about_text">{{$member->profile->about}}</p>
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
                                        </div>
                                        @if ($member->type=="professor" || $member->type=="student")
                                            <div class="col-6">
                                                <p class="item_title">دانشکده</p>
                                                <p class="item_value">{{$member->department ? $member->department->title : '-'}}</p>
                                            </div>
                                        @endif

                                        <div class="col-6">
                                            @if ($member->type=="professor")
                                                <p class="item_title">رتبه</p>
                                                <p class="item_value">{{$member->rank->title}}</p>
                                            @elseif ($member->type=="student")
                                                <p class="item_title">@lang('trs.degree')</p>
                                                <p class="item_value">{{$member->degree->title}}</p>
                                            @else
                                                <p class="item_title">@lang('trs.degree_of_education')</p>
                                                <p class="item_value">{{$member->degree->title}}</p>
                                            @endif

                                        </div>
                                        <div class="col-6">
                                            @if ($member->type=="professor")
                                                <p class="item_title">گروه</p>
                                                <p class="item_value">{{$member->group}}</p>
                                            @elseif($member->type=="student")
                                                <p class="item_title">شماره دانشجویی</p>
                                                <p class="item_value">{{$member->student_number}}</p>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($current_member && $current_member->id==$member->id)
                            <div class="row justify-content-around">
                                <div class="col-4 text-center">
                                    <a href="{{route('profile_edit')}}" class="edit_profile_button">
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


    @if (session('account_alert'))
        <div class="modal fade" id="accountAlertModal" tabindex="-1" aria-labelledby="accountAlertModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>
                            {{session('account_alert')}}
                        </p>

                        <div class="login_register_modal">
                            <p>
                                <a href="{{route('logout')}}">@lang('trs.logout')</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

