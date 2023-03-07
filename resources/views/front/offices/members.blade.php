@extends('layouts.office')
@section('content')

    @include('front.offices.menu')

    <div class="page_wrapper">
        <div class="office_members">
            <div class="offices_container">
                <div class="row">
                    @foreach($members as $member)
                        <div class="col-12 col-lg-3">
                            <div class="office_members--container">
                                <div class="office_members--avatar">
                                    <img src="{{$member->profile->avatar}}" title="" alt="">
                                </div>
                                <div class="office_members--name">
                                    <a href="{{route('profile_show',$member->id)}}">
                                        <span>{{$member->profile->fullName}}</span>
                                    </a>
                                </div>

                                <div class="office_member--rank">
                                    <span>{{$member->type=="professor" ? trans('trs.rank')." : " . $member->rank->title : trans('trs.grade')." : " . $member->degree->title}}</span>
                                </div>

                                <div class="office_members--role">
                        <span>
                            سمت :
                             @php($i=0)
                            @foreach($member->roles as $role)
                                @if ($i)
                                    ,
                                @endif

                                {{$role->title}}

                                @php($i=1)
                            @endforeach
                        </span>
                                </div>

                                <div class="office_members--social">
                                    <ul>
                                        @if ($member->profile->linkedin)
                                            <li>
                                                <a href="{{$member->profile->linkedin}}"><i
                                                        class="fa-brands fa-linkedin"></i></a>
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
                                                        class="fa-solid fa-file-pdf"></i><span> @lang('trs.resume')</span></a>
                                            </li>
                                        @endif

                                    </ul>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($type=="head" && $office->headIntroduction)
                    <div class="office_member--head-intro">
                        <div class="office_member--head-intro--title">
                            <p>@lang('trs.head_introduction_video')</p>
                        </div>
                        <div class="office_member--head-intro--video">
                            <video controls>
                                <source src="{{$office->headIntroduction}}">
                            </video>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
