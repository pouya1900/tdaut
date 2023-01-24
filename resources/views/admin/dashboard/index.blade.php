@extends('layouts.admin')

@section('content')

    @include('front.partials.error_message')

    <div class="row">
        <div class="col-6">
            <span>@lang('trs.number_of_members') : </span>
            <span>{{$members->count()}}</span>
        </div>
        <div class="col-6">
            <span>@lang('trs.number_of_users') : </span>
            <span>{{$users->count()}}</span>
        </div>
        <div class="col-6">
            <span>@lang('trs.number_of_offices') : </span>
            <span>{{$offices->count()}}</span>
        </div>
        <div class="col-6">
            <span>@lang('trs.number_of_products') : </span>
            <span>{{$products->count()}}</span>
        </div>
    </div>
@endsection
