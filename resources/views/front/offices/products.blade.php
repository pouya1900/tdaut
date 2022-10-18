@extends('layouts.office')
@section('content')


    <div class="mobile_filter_container d-lg-none">
        <div class="mobile_filter_content">
            <span id="mobile_filter_button"><i
                    class="fas fa-filter"></i> @lang('trs.filter')</span>
        </div>
    </div>

    <div class="page_wrapper">

        <div class="row m-0">
            <div id="side_filter_main_container"
                 class="col-lg-2 d-lg-block d-none flight_side_bar_modal flight_sidebar_container sticky-sidebar padding-right-5px padding-left-5px">
                <div id="modal-div">
                    <div id="modal-dialog-div">
                        <div id="modal-content-div">
                            <div id="modal-body-div">
                                <div class="side_filter_content">
                                    @include('front.offices.product_side_filter')
                                </div>
                                <div class="d-lg-none">
                                    <div class="filter_modal_close_container">
                                        <span class="filter_modal_close"><i class="fas fa-sort-amount-down"></i> @lang('trs.show_filter_result')</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-12 products_body">

                <div class="products">
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-12 col-lg-3">
                                <div class="product">
                                    <div class="vr_tour_option">
                                        <span>تور مجازی</span>
                                    </div>
                                    <div class="product--logo">
                                        <a href="{{route('product_show',$product->id)}}">
                                            <img src="{{$product->logo}}" alt="{{$product->title}}"
                                                 title="{{$product->title}}">
                                        </a>
                                    </div>

                                    <div class="product--content">
                                        <a href="{{route('product_show',$product->id)}}">

                                            <div class="product--name">
                                                <span>{{$product->title}}</span>
                                            </div>
                                        </a>

                                        <div class="product--description">
                                            <span>{{$product->description}}</span>
                                        </div>
                                        <a href="{{route('office_show',$product->office->id)}}">
                                            <div class="product--office_name">
                                            <span><i
                                                    class="fa-solid fa-building"></i> {{$product->office->name}}</span>
                                            </div>
                                        </a>
                                        <div class="product--category">
                                            <img src="storage/assets/siteContent/category.png">
                                            <span>{{$product->category->title}}</span>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
