@extends('layouts.front')

@section('content')

    <div class="row m-0">

        @include('front.partials.profile_side_bar')

        <div class="col-12 col-lg-10 p-0">

            <div class="profile_main_wrapper">

                @if ($current_member && $current_member->id==$member->id && $current_member->type=="professor")
                    <div class="add_office_button">
                        <a href="{{route('mg.office_create')}}">@lang('trs.add_new_office')</a>
                    </div>

                    @if (count($errors))
                        <div class="alert alert-danger alert-dismissible register_form--alert" role="alert">
                            <strong>{{ $errors->first() }}</strong>
                        </div>
                    @endif

                @endif

                @foreach($member->offices()->distinct()->get() as $office)
                    <div class="profile_offices">
                        <a href="{{route('office_show',$office->id)}}">

                            <div class="profile_offices--container">
                                <div class="profile_office--logo">
                                    <img src="{{$office->logo}}" title="" alt="">
                                </div>
                                <div class="profile_office--name">
                                    <span>{{$office->name}}</span>
                                </div>
                                <div class="profile_office--role">
                                    <span>سمت :
                                    @php($i=0)
                                        @foreach($office->roles as $role)
                                            @if ($i)
                                                ,
                                            @endif

                                            {{$role->title}}

                                            @php($i=1)
                                        @endforeach
                                    </span>
                                </div>

                            </div>

                        </a>
                        @if ($current_member && $current_member->id==$member->id)

                            <div class="profile_office--button">
                                <a href="#">@lang('trs.enter_office_panel')</a>
                            </div>
                        @endif
                    </div>

                @endforeach
            </div>

        </div>

    </div>




@endsection
