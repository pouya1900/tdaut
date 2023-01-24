@extends('layouts.admin')

@section('content')
    <div class="my-table">
        @include('front.partials.error_message')
        @include('admin.offices.table')
    </div>
@endsection
