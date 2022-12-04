@extends('layouts.admin')

@section('content')
    <div class="my-table">
        @include('front.partials.error_message')

        @include('admin.reports.table')
    </div>
@endsection
