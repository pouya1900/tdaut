@extends('layouts.admin')

@section('style')

@endsection

@section('content')


    <div class="my-table">
        @include('front.partials.error_message')

        <div class="table_title">
            <p>{{$member->profile->fullName}}</p>
        </div>


        @include('admin.roles.offices_table')
    </div>


@endsection

@section('script')

@endsection
