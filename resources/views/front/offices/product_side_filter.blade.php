<!-- Sidebar -->

<div class="widget">
    {{--    <h4 class="widget-title filter_drop_down_link">--}}
    {{--        <span class=""> @lang('trs.stops') </span>--}}
    {{--        <span class="filter_drop_down"> ▲ </span>--}}
    {{--    </h4>--}}
    {{--depart--}}
    <div class="widget_content">

        <div class="widget-sub-title">
            <span>@lang('trs.stops')</span>

        </div>

        <div class="widget_item">

            <div class="custom-control custom-checkbox font-weight-600 ">

                <input type="checkbox" class="custom-control-input choose_all " id="depart_stops_all"
                       name="stops"
                       value="ALL" checked>

                <label class="custom-control-label"
                       for="depart_stops_all">@lang('trs.choose_all') </label>
            </div>

        </div>


    </div>
</div>



