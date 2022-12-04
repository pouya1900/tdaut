<div class="office_top_bar">
    <div class="row m-0">
        <div class="col-3">
            <div class="uni_logo">
                <img src="storage/assets/test/logo.jpg">

                @if ($current_user || $current_member)
                    <div class="office_top_bar_profile">
                        <span><i class="fa-solid fa-user"></i></span>
                        @if ($current_member)
                            <span><a
                                    href="{{route('profile_show',$current_member->id)}}">{{$current_member->profile->fullName}}</a></span>
                        @else
                            <span><a
                                    href="{{route('user_show',$current_user->id)}}">{{$current_user->profile->fullName}}</a></span>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        <div class="col-6">
            <div class="office_title">
                <a href="{{route('office_show',$office->id)}}">
                    <h5>{{$office->name}}</h5>
                </a>
            </div>

        </div>
        <div class="col-3">
            <div class="office_logo">
                <span class="logout"><a href="{{route('logout')}}">@lang('trs.logout')</a></span>

                <a href="{{route('office_show',$office->id)}}">
                    <img src="{{$office->logo}}" title="{{$office->name}}" alt="{{$office->name}}">
                </a>
            </div>
        </div>
    </div>
</div>
