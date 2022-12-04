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
                        @include('front.users.rfps.table')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('office.rfps.description')
    @include('office.rfps.proposals')

@endsection

@section('script')

@endsection