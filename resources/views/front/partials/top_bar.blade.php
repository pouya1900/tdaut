<div class="top_bar">

    @if ($current_user || $current_member)

        <div class="top_bar_profile">
            <span><i class="fa-solid fa-user"></i></span>
            <span>
                @if ($current_member)
                    <a href="{{route('profile_show',$current_member->id)}}">{{$current_member->profile->fullName}}</a>
                @else
                    <a href="{{route('user_show',$current_user->id)}}">{{$current_user->profile->fullName}}</a>
                @endif
            </span>
        </div>
    @else
        <div class="top_bar_profile">
            <div class="login_register">
                <span><a href="{{route('register_member')}}">ثبت نام</a></span>
                <span>/</span>
                <span><a href="{{route('login','member')}}">ورود</a></span>
                <span>اعضا</span>
            </div>
            <div class="login_register">
                <span><a href="{{route('register_user')}}">ثبت نام</a></span>
                <span>/</span>
                <span><a href="{{route('login','user')}}">ورود</a></span>
                <span>کارفرمایان</span>
            </div>
        </div>
    @endif

    <div class="site_name_middle">
        <a href="{{route('index')}}">{{$setting->title}}</a>
    </div>
    @if ($current_user || $current_member)

        <div class="top_bar_logo">
            <span class="logout"><a href="{{route('logout')}}">@lang('trs.logout')</a></span>
            {{--            <img src="" alt="">--}}
        </div>
    @endif


</div>
