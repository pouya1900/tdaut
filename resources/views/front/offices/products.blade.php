@extends('layouts.office')
@section('content')


    <div class="mobile_filter_container d-lg-none">
        <div class="mobile_filter_content">
            <span id="mobile_filter_button"><i
                    class="fas fa-filter"></i> @lang('trs.filter')</span>
        </div>
    </div>

    <div class="page_wrapper">

        <div id="app">
            <product-index
                :trs="{{json_encode(trans('trs'))}}"
                :products="{{json_encode($products)}}"
                :categories="{{json_encode($categories)}}"
                :categories_id="{{json_encode($categories_id)}}">
            </product-index>
        </div>
    </div>

@endsection
