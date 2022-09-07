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

            </div>
        </div>
    </div>

@endsection
