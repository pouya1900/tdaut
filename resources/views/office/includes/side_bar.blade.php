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
                <li class="{{url()->current()==route('mg.office_members',$office->id) || (isset($member) && url()->current()==route('mg.office_members_edit',['office'=>$office->id,'member'=>$member->id])) || url()->current()==route('mg.office_member_create',$office->id) ? "active" : ""}}">
                    <a href="{{route('mg.office_members',$office->id)}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.members')</a>
                </li>

                <li class="{{url()->current()==route('mg.office_roles',$office->id) || (isset($role) && url()->current()==route('mg.office_roles_edit',['office'=>$office->id,'role'=>$role->id])) ? "active" : ""}}">
                    <a href="{{route('mg.office_roles',$office->id)}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.roles')</a>
                </li>

                <li class="{{url()->current()==route('mg.content_edit',$office->id) ? "active" : ""}}">
                    <a href="{{route('mg.content_edit',$office->id)}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.content')</a>
                </li>

                <li class="{{url()->current()==route('mg.supports',$office->id) || (isset($support) && url()->current()==route('mg.support_show',['office'=>$office->id,'support'=>$support->id])) ? "active" : ""}}">
                    <a href="{{route('mg.supports',$office->id)}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.supports')</a>
                </li>
                <li class="{{url()->current()==route('mg.messages',$office->id) || (isset($default_user) && url()->current()==route('mg.messages',['office'=>$office->id,'user'=>$default_user->id])) ? "active" : ""}}">
                    <a href="{{route('mg.messages',$office->id)}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.messages')</a>
                </li>
                <li class="{{url()->current()==route('mg.rfps',$office->id) ? "active" : ""}}">
                    <a href="{{route('mg.rfps',$office->id)}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.rfps')</a>
                </li>
                <li class="{{url()->current()==route('mg.products',$office->id) ? "active" : ""}}">
                    <a href="{{route('mg.products',$office->id)}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.products')</a>
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
