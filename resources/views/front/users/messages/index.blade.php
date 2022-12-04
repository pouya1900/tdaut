@extends('layouts.front')

@section('style')
    <link rel="stylesheet" href="storage/css/chat.css">
@endsection

@section('content')

    <div class="row m-0 full-height">

        @include('front.partials.user_side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="profile_main_wrapper">
                <div class="profile_main">
                    <div class="row m-0">
                        <div class="col-12 col-lg-3 p-0">
                            @include('front.users.messages.offices_list')
                        </div>
                        <div class="d-none d-lg-block col-lg-9 p-0">
                            @include('front.users.messages.show')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
