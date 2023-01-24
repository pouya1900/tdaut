@extends('layouts.admin')

@section('style')

@endsection

@section('content')


    <div class="my-table">
        <div class="new_member_button">
            @if (!$type)
                <a href="{{route('admin.members',['type'=>'professor'])}}">@lang('trs.professors')</a>
            @else
                <a href="{{route('admin.members')}}">@lang('trs.all_members')</a>
            @endif
        </div>

        @include('front.partials.error_message')


        @include('admin.members.table')
    </div>


@endsection

@section('script')

@endsection
