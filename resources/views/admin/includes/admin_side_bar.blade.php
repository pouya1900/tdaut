<div id="profile_side" class="display-none d-lg-block col-lg-2 p-0">
    <div class="profile_side_container">
        <div class="profile_info">
            <p class="profile_side-info--name">{{$admin->profile->fullName}}</p>
            <p class="profile_side-info--type">{{$admin->role->title}}</p>
        </div>

        <div class="profile_side-item--container">
            <ul>
                <li class="{{url()->current()==route('admin.dashboard') ? "active" : ""}}">
                    <a href="{{route('admin.dashboard')}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.dashboard')</a>
                </li>
                <li class="{{url()->current()==route('admin.offices') || (isset($office) && (url()->current()==route('admin.office.edit',$office->id) || url()->current()==route('admin.office.members',$office->id))) ? "active" : ""}}">
                    <a href="{{route('admin.offices')}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.offices')</a>
                </li>
                <li class="{{url()->current()==route('admin.products') || (isset($product) && url()->current()==route('admin.product.edit',$product->id)) ? "active" : ""}}">
                    <a href="{{route('admin.products')}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.products')</a>
                </li>
                <li class="{{url()->current()==route('admin.users') || (isset($user) && url()->current()==route('admin.user.edit',$user->id)) ? "active" : ""}}">
                    <a href="{{route('admin.users')}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.users')</a>
                </li>
                <li class="{{url()->current()==route('admin.members') || (isset($member) && (url()->current()==route('admin.member.edit',$member->id) || url()->current()==route('admin.member.offices',$member->id))) ? "active" : ""}}">
                    <a href="{{route('admin.members')}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.members')</a>
                </li>
                <li class="{{url()->current()==route('admin.supports','office') || (isset($support) && isset($office) && url()->current()==route('admin.support.show',$support->id))? "active" : ""}}">
                    <a href="{{route('admin.supports','office')}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.office_support')</a>
                </li>
                <li class="{{url()->current()==route('admin.tags') || url()->current()==route('admin.tag.create') || (isset($tag) && url()->current()==route('admin.tag.edit',$tag->id))? "active" : ""}}">
                    <a href="{{route('admin.tags')}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.tags')</a>
                </li>
                <li class="{{url()->current()==route('admin.supports','user') || (isset($support) && isset($user) && url()->current()==route('admin.support.show',$support->id))? "active" : ""}}">
                    <a href="{{route('admin.supports','user')}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.user_support')</a>
                </li>
                <li class="{{url()->current()==route('admin.categories') || url()->current()==route('admin.category.create') || (isset($category) && url()->current()==route('admin.category.edit',$category->id))? "active" : ""}}">
                    <a href="{{route('admin.categories')}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.categories')</a>
                </li>
                <li class="{{url()->current()==route('admin.degrees') || url()->current()==route('admin.degree.create') || (isset($degree) && url()->current()==route('admin.degree.edit',$degree->id))? "active" : ""}}">
                    <a href="{{route('admin.degrees')}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.degrees')</a>
                </li>
                <li class="{{url()->current()==route('admin.departments') || url()->current()==route('admin.department.create') || (isset($department) && url()->current()==route('admin.department.edit',$department->id))? "active" : ""}}">
                    <a href="{{route('admin.departments')}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.departments')</a>
                </li>
                <li class="{{url()->current()==route('admin.ranks') || url()->current()==route('admin.rank.create') || (isset($rank) && url()->current()==route('admin.rank.edit',$rank->id))? "active" : ""}}">
                    <a href="{{route('admin.ranks')}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.ranks')</a>
                </li>
                <li class="{{url()->current()==route('admin.reports.types') || url()->current()==route('admin.reports.type.create') || (isset($report_type) && url()->current()==route('admin.reports.type.edit',$report_type->id))? "active" : ""}}">
                    <a href="{{route('admin.reports.types')}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.report_types')</a>
                </li>

                <li class="{{url()->current()==route('admin.reports') || (isset($report) && url()->current()==route('admin.report.show',$report->id))? "active" : ""}}">
                    <a href="{{route('admin.reports')}}"> <i
                            class="fa-solid fa-user"></i>@lang('trs.reports')</a>
                </li>
            </ul>
        </div>

    </div>
</div>

<div class="d-lg-none profile_side-mobile-button">
    {{--    <button><i class="fa-solid fa-bars"></i></button>--}}
    <button id="profile_side_menu"><i
            class="fa-solid fa-bars"></i></button>
</div>
