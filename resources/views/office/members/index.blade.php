@extends('layouts.office_panel')

@section('style')

@endsection

@section('content')

    <div class="row m-0 full-height">

        @include('office.includes.side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="mg-office-dashboard">
                <div class="my-table">
                    <div class="new_member_button">
                        <a href="{{route('mg.office_member_create',$office->id)}}">@lang('trs.add_new_member')</a>
                    </div>

                    @include('front.partials.error_message')


                    @include('office.members.table')
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
