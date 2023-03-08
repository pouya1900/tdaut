<div class="office_top_bar">
    <div class="row m-0">
        <div class="col-4">
            <div class="profile_info--container">

                @if ($current_user || $current_member)
                    <div class="office_top_bar_profile">
                        <span><i class="fa-solid fa-user"></i></span>
                        @if ($current_member)
                            <span><a
                                    href="{{route('profile_show',$current_member->id)}}">{{$current_member->profile->fullName}}</a></span>
                            <span class="logout"><a href="{{route('logout')}}"><i class="fa-solid fa-right-from-bracket"></i> @lang('trs.logout')</a></span>
                        @else
                            <span><a
                                    href="{{route('user_show',$current_user->id)}}">{{$current_user->profile->fullName}}</a></span>
                            <span class="logout"><a href="{{route('logout')}}"><i class="fa-solid fa-right-from-bracket"></i> @lang('trs.logout')</a></span>

                        @endif
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
            </div>
        </div>
        <div class="col-4">
            <div class="office_title">
                <a href="{{route('office_show',$office->id)}}">
                    <h5>{{$office->name}}</h5>
                </a>
            </div>

        </div>
        <div class="col-4">
            <div class="office_logo">
                <span class="main_tech_page_link"><a href="{{route('offices')}}">@lang('trs.technology_service_center')</a></span>

                <a href="{{route('index')}}">
                    <img src="{{$setting->logo}}" title="{{$setting->title}}" alt="{{$setting->title}}">
                </a>
            </div>
        </div>
    </div>
</div>
