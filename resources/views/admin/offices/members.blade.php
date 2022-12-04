@extends('layouts.admin')

@section('style')

@endsection

@section('content')


    <div class="my-table">
        @include('front.partials.error_message')

        <div class="table_title">
            <p>{{$office->name}}</p>
        </div>


        @include('admin.roles.members_table')
    </div>


@endsection

@section('script')

@endsection
