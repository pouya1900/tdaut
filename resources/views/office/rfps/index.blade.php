@extends('layouts.office_panel')

@section('style')

@endsection

@section('content')

    <div class="row m-0 full-height">

        @include('office.includes.side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="mg-office-dashboard">
                <div class="my-table">

                    @include('office.includes.error_message')

                    @include('office.rfps.table')
                </div>

            </div>
        </div>
    </div>

    @include('office.rfps.description')
    @include('office.rfps.proposals')

@endsection

@section('script')

@endsection
