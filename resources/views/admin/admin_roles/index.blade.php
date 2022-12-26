@extends('layouts.admin')

@section('content')
    <div class="my-table">
        @include('front.partials.error_message')

        @include('admin.admin_roles.table')
    </div>
@endsection
