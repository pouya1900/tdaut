@extends('layouts.front')

@section('content')

    <div class="row m-0">

        @include('front.partials.profile_side_bar')

        <div class="col-12 col-lg-10 p-0">

            <div class="profile_main_wrapper">
                @foreach($member->offices as $office)
                    <a href="{{route('office_show',$office->id)}}">
                        <div class="profile_offices">

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

                        </div>
                    </a>
                @endforeach
            </div>

        </div>

    </div>




@endsection
