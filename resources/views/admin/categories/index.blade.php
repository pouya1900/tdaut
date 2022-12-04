@extends('layouts.admin')

@section('content')
    <div class="my-table">
        @include('front.partials.error_message')

        <div class="new_member_button">
                <a href="{{route('admin.category.create')}}">@lang('trs.new_category')</a>
        </div>

        @include('admin.includes.general_table')
    </div>
@endsection
