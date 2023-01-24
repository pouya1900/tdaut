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
                        <div class="new_ticket_button">
                            <a href="{{route('user_support_new_ticket')}}"><i
                                    class="fa-solid fa-envelope-open-text"></i> @lang('trs.add_new_ticket')</a>
                        </div>
                        @include('front.partials.error_message')
                        @include('front.partials.supports_table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
