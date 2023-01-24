@extends('layouts.front')

@section('style')

@endsection

@section('content')

    <div class="row m-0 full-height">

        @include('front.partials.user_side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="profile_main_wrapper">
                <div class="profile_main">
                    <div class="my-table">
                        @include('front.partials.error_message')

                        <div class="new_member_button">
                            <a href="{{route('user_new_rfp_create')}}">@lang('trs.new_rfp')</a>
                        </div>

                        @include('front.users.rfps.table')
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')

@endsection
