<div class="top_bar">

    @if ($current_user || $current_member)

        <div class="top_bar_profile">
            <span><i class="fa-solid fa-user"></i></span>
            <span>
                @if ($current_member)
                    <a href="{{route('profile_show',$current_member->id)}}">{{$current_member->profile->fullName}}</a>
                    <span class="logout"><a href="{{route('logout')}}"><i class="fa-solid fa-right-from-bracket"></i> @lang('trs.logout')</a></span>

                @else
                    <a href="{{route('user_show',$current_user->id)}}">{{$current_user->profile->fullName}}</a>
                    <span class="logout"><a href="{{route('logout')}}"><i class="fa-solid fa-right-from-bracket"></i> @lang('trs.logout')</a></span>

                @endif
            </span>
        </div>
    @else
        <div class="top_bar_profile">
            <div class="login_register">
                <span><a
                        href="{{route('login','member')}}"><i
                            class="fa-solid fa-right-to-bracket"></i>ورود اعضا </a></span>
            </div>
            <div class="login_register">
                <span><a
                        href="{{route('login','user')}}"> <i
                            class="fa-solid fa-right-to-bracket"></i>ورود کارفرمایان</a></span>
            </div>
        </div>
    @endif

    <div class="site_name_middle">
        <a href="{{route('offices')}}">@lang('trs.technology_service_center')</a>
    </div>
    <div class="top_bar_logo">
        <a href="{{route('index')}}">
            <img src="{{$setting->logo}}" title="{{$setting->title}}" alt="{{$setting->title}}">
        </a>
    </div>

</div>
