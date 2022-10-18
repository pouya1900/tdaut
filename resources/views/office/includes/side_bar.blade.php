<div id="office_side" class="display-none d-lg-block col-lg-2 p-0">
    <div class="profile_side_container">
        <div class="profile_info">
            <img src="{{$office->logo}}" title="" alt="">
            <p class="profile_side-info--name">{{$office->name}}</p>
        </div>

        <div class="profile_side-item--container">
            <ul>
                <li class="{{url()->current()==route('mg.office',$office->id) ? "active" : ""}}">
                    <a href="{{route('mg.office',$office->id)}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.dashboard')</a>
                </li>
                <li class="{{url()->current()==route('mg.office_capabilities',$office->id) ? "active" : ""}}">
                    <a href="{{route('mg.office_capabilities',$office->id)}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.capabilities')</a>
                </li>
                <li class="{{url()->current()==route('mg.office_members',$office->id) ? "active" : ""}}">
                    <a href="{{route('mg.office_members',$office->id)}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.members')</a>
                </li>

            </ul>
        </div>
    </div>
</div>

<div class="d-lg-none profile_side-mobile-button">
    {{--    <button><i class="fa-solid fa-bars"></i></button>--}}
    <button id="profile_side_menu"><img src="{{$office->logo}}" title="" alt=""><i
            class="fa-solid fa-bars"></i></button>
</div>
