@extends('layouts.office_panel')

@section('style')
    <link rel="stylesheet" href="storage/css/chat.css">
@endsection

@section('content')

    <div class="row m-0 full-height">

        @include('office.includes.side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="mg-office-dashboard mg-office-dashboard-fix">

                <div class="row m-0">
                    @if ($default_user)

                        <div class="col-12 col-lg-3 p-0">
                            @include('office.messages.users_list')
                        </div>
                        <div class="d-none d-lg-block col-lg-9 p-0">
                            @include('office.messages.show')
                        </div>

                    @else
                        <div class="col-12">
                            <p>@lang('trs.no_message_yet')</p>
                        </div>

                    @endif

                </div>


            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
