@extends('layouts.admin')

@section('content')
    <div class="my-table">
        <div class="new_member_button">
            @if (!$filter)
                <a href="{{route('admin.offices',['filter'=>'pending'])}}">@lang('trs.pending_offices')</a>
            @else
                <a href="{{route('admin.offices')}}">@lang('trs.all_offices')</a>
            @endif
        </div>

        @include('front.partials.error_message')
        <div class="admin_tables_title">
            <h6>
                @if (!$filter)
                    @lang('trs.all_offices')
                @else
                    @lang('trs.pending_offices')

                @endif
            </h6>
        </div>
        @include('admin.offices.table')
    </div>
@endsection
