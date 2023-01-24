@extends('layouts.admin')

@section('style')

@endsection

@section('content')


    <div class="my-table">
        <div class="new_member_button">
            @if (!$filter)
                <a href="{{route('admin.users',['filter'=>'pending'])}}">@lang('trs.pending_users')</a>
            @else
                <a href="{{route('admin.users')}}">@lang('trs.all_users')</a>
            @endif
        </div>

        @include('front.partials.error_message')


        @include('admin.users.table')
    </div>


@endsection

@section('script')

@endsection
