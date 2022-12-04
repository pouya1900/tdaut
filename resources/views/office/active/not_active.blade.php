@extends('layouts.office_panel')

@section('content')

    <div class="row m-0 full-height">

        @include('office.includes.side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="mg-office-dashboard">
                <div class="row">
                    <div class="col-12">
                        <p>
                            @lang('trs.office_not_verified_yet')
                        </p>
                    </div>
                    <div class="col-6">
                        <span>@lang('status') : </span>
                        <span>
                            {{\App\Helper::officeStatusToTranslated($office->status)}}
                        </span>
                    </div>

                    <div class="col-6">
                        <div>
                            <span>@lang('trs.status_change_date') : </span>
                            <span>{{$office->status_date}}</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <h6>@lang('trs.status_text')</h6>
                        <p>{{$office->status_message}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
