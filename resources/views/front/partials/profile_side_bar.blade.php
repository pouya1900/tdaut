<div id="profile_side" class="display-none d-lg-block col-lg-2 p-0">
    <div class="profile_side_container">
        <div class="profile_info">
            <img src="{{$member->profile->avatar}}" title="" alt="">
            <p class="profile_side-info--name">{{$member->profile->fullName}}</p>
            <p class="profile_side-info--type">{{\App\Helper::memberType($member->type)}}</p>
        </div>

        <div class="profile_side-item--container">
            <ul>
                <li class="{{url()->current()==route('profile_show',$member->id) || url()->current()==route('profile_edit') ? "active" : ""}}">
                    <a href="{{route('profile_show',$member->id)}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.profile')</a>
                </li>
                <li class="{{url()->current()==route('profile_offices',$member->id) ? "active" : ""}}">
                    <a href="{{route('profile_offices',$member->id)}}"> <i
                            class="fa-solid fa-building"></i>@lang('trs.offices')</a>
                </li>
                @if ($current_member && $current_member->id==$member->id)
                    <li class="{{url()->current()==route('profile_password') ? "active" : ""}}">
                        <a href="{{route('profile_password')}}"> <i class="fa-solid fa-key"></i>@lang('trs.password')
                        </a>
                    </li>
                @endif


            </ul>
        </div>

    </div>
</div>

<div class="d-lg-none profile_side-mobile-button">
    {{--    <button><i class="fa-solid fa-bars"></i></button>--}}
    <button id="profile_side_menu"><img src="{{$member->profile->avatar}}" title="" alt=""><i
            class="fa-solid fa-bars"></i></button>
</div>
