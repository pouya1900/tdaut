@extends('layouts.admin')

@section('style')

@endsection

@section('content')


    <div class="my-table">
        <div class="new_member_button">
            <a href="{{route('admin.admin.create')}}">@lang('trs.new_admin')</a>
        </div>

        @include('front.partials.error_message')


        @include('admin.admins.table')
    </div>


@endsection

@section('script')

@endsection
