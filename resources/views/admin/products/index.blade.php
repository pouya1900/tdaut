@extends('layouts.admin')

@section('style')

@endsection

@section('content')


    <div class="my-table">
        <div class="new_member_button">
            @if (!$filter)
                <a href="{{route('admin.products',['filter'=>'pending'])}}">@lang('trs.pending_products')</a>
            @else
                <a href="{{route('admin.products')}}">@lang('trs.all_products')</a>
            @endif
        </div>

        @include('front.partials.error_message')


        @include('admin.products.table')
    </div>


@endsection

@section('script')

@endsection
