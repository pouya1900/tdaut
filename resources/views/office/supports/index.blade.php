@extends('layouts.office_panel')

@section('style')

@endsection

@section('content')

    <div class="row m-0 full-height">

        @include('office.includes.side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="mg-office-dashboard">

                <div class="my-table">
                    <div class="new_ticket_button">
                        <a href="{{route('mg.support_new_ticket',$office->id)}}"><i
                                class="fa-solid fa-envelope-open-text"></i>  @lang('trs.add_new_ticket')</a>
                    </div>
                    @include('office.includes.error_message')
                    @include('office.supports.table')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
