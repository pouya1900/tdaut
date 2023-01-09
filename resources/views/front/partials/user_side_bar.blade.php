<div id="profile_side" class="display-none d-lg-block col-lg-2 p-0">
    @php
        if ($current_user && $current_user->id==$user->id) {
            $unseen_proposal=$current_user->rfps()->wherehas('documents',function ($q) {
                return $q->where('seen_at',null)->where('type','proposal');
            })->first();
    }
    @endphp
    <div class="profile_side_container">
        <div class="profile_info">
            <img src="{{$user->profile->avatar}}" title="" alt="">
            <p class="profile_side-info--name">{{$user->profile->fullName}}</p>
            <p class="profile_side-info--type">{{\App\Helper::userType($user->type)}}</p>
        </div>

        <div class="profile_side-item--container">
            <ul>
                <li class="{{url()->current()==route('user_show',$user->id) || url()->current()==route('user_edit') ? "active" : ""}}">
                    <a href="{{route('user_show',$user->id)}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.profile')</a>
                </li>

                @if ($current_user && $current_user->id==$user->id)
                    <li class="{{url()->current()==route('user_password') ? "active" : ""}}">
                        <a href="{{route('user_password')}}"> <i class="fa-solid fa-key"></i>@lang('trs.password')
                        </a>
                    </li>


                    <li class="{{url()->current()==route('user_rfps') || (isset($rfp) && url()->current()==route('user_rfp_show',$rfp->id)) ? "active" : ""}}">
                        <a href="{{route('user_rfps')}}"> <i
                                class="fa-solid fa-user"></i>@lang('trs.rfps_and_proposal')</a>
                        @if (isset($unseen_proposal))
                            <span class="admin_notification">*</span>
                        @endif
                    </li>

                    <li class="{{url()->current()==route('user_supports') || (isset($support) && url()->current()==route('user_support_show',$support->id)) || url()->current()==route('user_support_new_ticket') ? "active" : ""}}">
                        <a href="{{route('user_supports')}}"> <i
                                class="fa-solid fa-user"></i>@lang('trs.supports')</a>
                    </li>

                    <li class="{{url()->current()==route('user_messages')  ? "active" : ""}}">
                        <a href="{{route('user_messages')}}"> <i
                                class="fa-solid fa-user"></i>@lang('trs.messages')</a>
                    </li>
                @endif
            </ul>
        </div>

    </div>
</div>

<div class="d-lg-none profile_side-mobile-button">
    {{--    <button><i class="fa-solid fa-bars"></i></button>--}}
    <button id="profile_side_menu"><img src="{{$user->profile->avatar}}" title="" alt=""><i
            class="fa-solid fa-bars"></i></button>
</div>
